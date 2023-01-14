<?php
    include "functions.php";

    $error = false;
    $config = include './config.php';
    $userId = $_GET["userId"];

    if(isset($_POST["submit"])) {
        $result = [
            "error" => false,
            "message" => "User Updated success!"
        ];

        try {
            [
                "host" => $host,
                "user" => $user,
                "pass" => $pass,
                "name" => $name,
                "options" => $options
            ] = $config["db"];
        
            $connection = new PDO("mysql:host=$host;dbname=$name", $user, $pass, $options);

            $student = [
                "name" => $_POST["name"],
                "surname" => $_POST["surname"],
                "email" => $_POST["email"],
                "age" => intval($_POST["age"]),
                "age" => $_POST["age"],
                "id" => $userId
            ];
            
            $sql_query = <<< END
                UPDATE Students
                SET name=:name,
                surname=:surname,
                email=:email,
                age=:age
                WHERE id=:id
            END;

            $sentence = $connection->prepare($sql_query);

            foreach($student as $key => $field) {
                $type = $key === "id" || $key === "age" ? PDO::PARAM_INT : PDO::PARAM_STR;

                $sentence->bindValue(":$key", $field, $type);
            }

            $sentence->execute();
        } catch (PDOException $error) {
            $result["error"] = true;
            $result["message"] = $error->getMessage();
        }
    }

    try {
        [
            "host" => $host,
            "user" => $user,
            "pass" => $pass,
            "name" => $name,
            "options" => $options
        ] = $config["db"];
    
        $connection = new PDO("mysql:host=$host;dbname=$name", $user, $pass, $options);
        $sql_query = "SELECT * FROM Students WHERE id = $userId";

        $sentence = $connection->prepare($sql_query);
        $sentence->execute();
        $student = $sentence->fetch();
    } catch (PDOException $error) {
        $error = $error->getMessage();
    }
?>

<?php include "parts/header.php" ?>
<?php if($error): ?>
    <div class="container mt-2">
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-danger" role="alert">
                    <?= $error ?>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
<?php if(isset($result)): ?>
    <div class="container mt-3">
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-<?= $result['error'] ? 'danger' : 'success' ?>" role="alert">
                    <?= $result["message"] ?>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
    <div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2 class="mt-4">Editar un alumno</h2>
        </div>
        <hr>
        <?php if(!$student): ?>
            <p class="text-center">No existe el usuario con el id <?= $userId ?></p>
        <?php else: ?>
        <form method="post" action="<?= $_SERVER['PHP_SELF']?>?userId=<?= $student["id"] ?>">
            <div class="form-group">
                <label for="name">Nombre</label>
                <input type="text" name="name" id="name" class="form-control" value="<?= $student["name"] ?>">
            </div>
            <div class="form-group">
                <label for="surname">Apellido</label>
                <input type="text" name="surname" id="surname" class="form-control" value="<?= $student["surname"] ?>">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" value="<?= $student["email"] ?>">
            </div>
            <div class="form-group">
                <label for="age">Edad</label>
                <input type="text" name="age" id="age" class="form-control" value="<?= $student["age"] ?>">
            </div>
            <button type="submit" name="submit" class="btn btn-warning">Enviar</button>
        </form>
        <?php endif; ?>
        <div class="form-group">
            <a class="btn btn-primary" href="index.php">Regresar al inicio</a>
        </div>
    </div>
</div>

<?php include "parts/footer.php" ?>
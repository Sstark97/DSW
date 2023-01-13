<?php
    include "functions.php";

    $error = false;
    $config = include './config.php';

    try {
        [
            "host" => $host,
            "user" => $user,
            "pass" => $pass,
            "name" => $name,
            "options" => $options
        ] = $config["db"];
    
        $connection = new PDO("mysql:host=$host;dbname=$name", $user, $pass, $options);

        $sql_query = "SELECT * FROM Students";

        $sentence = $connection->prepare($sql_query);
        $sentence->execute();
        $students = $sentence->fetchAll();
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

<div class="container"></div>
    <div class="row">
        <div class="col-md-12">
            <h2 class="mt-3">Lista de alumnos/as</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Apellidos</th>
                        <th>Email</th>
                        <th>Edad</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    <?php if($students && $sentence->rowCount()): ?>
                        <?php foreach($students as $student): ?>
                            <tr>
                                <td>
                                    <?= htmlCodifier($student["id"]) ?>
                                </td>
                                <td>
                                    <?= htmlCodifier($student["name"]) ?>
                                </td>
                                <td>
                                    <?= htmlCodifier($student["surname"]) ?>
                                </td>
                                <td>
                                    <?= htmlCodifier($student["email"]) ?>
                                </td>
                                <td>
                                    <?= htmlCodifier($student["age"]) ?>
                                </td>

                                <td>
                                    <button class="btn btn-warning">
                                        <a href="./edit.php?userId=<?= $student["id"] ?>">Actualizar</a>
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <a href="index.php" class="btn btn-primary mt-4">Regresar al inicio</a>
            </div>
        </div>
    </div>
</div>
<?php include "parts/footer.php" ?>
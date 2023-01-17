<?php
    require_once "../db_functions.php";
    require_once "../parts/parts.php";

    [
        "get_error_student" => $get_error_student,
        "student" => $student
    ] = getStudent();
?>

<?= createHeader() ?>
    <?php if(isset($_POST["submit"])): ?>
        <?php $result = editStudent(); ?>
    <?php endif; ?>

    <?php if($get_error_student): ?>
        <div class="container mt-2">
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-danger" role="alert">
                        <?= $get_error_student ?>
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
            <p class="text-center">No existe el usuario con el id <?= $_GET["userId"] ?></p>
            <div class="container text-center">
                <div class="row">
                    <div class="col align-self-center">
                        <a href="../index.php" class="btn btn-primary mt-4">Regresar al inicio</a>
                    </div>
                </div>
            </div>
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
            <div class="form-group mt-3">
                <button type="submit" name="submit" class="btn btn-warning">Enviar</button>
                <a class="btn btn-primary" href="../index.php">Regresar al inicio</a>
            </div>
        </form>
        <?php endif; ?>
    </div>
</div>

<?= createFooter() ?>
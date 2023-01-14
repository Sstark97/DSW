<?php
    require_once "../db_functions.php";
    require_once "../parts/parts.php";
?>

<?= createHeader() ?>
    <?php if(isset($_POST["submit"])): ?>
        <?php $result = createStudent(); ?>
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
                <h2 class="mt-4">Crear un alumno</h2>
            </div>
            <hr>
            <form method="post" action="<?= $_SERVER['PHP_SELF']?>">
                <div class="form-group">
                    <label for="name">Nombre</label>
                    <input type="text" name="name" id="name" class="form-control">
                </div>
                <div class="form-group">
                    <label for="surname">Apellido</label>
                    <input type="text" name="surname" id="surname" class="form-control">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control">
                </div>
                <div class="form-group">
                    <label for="age">Edad</label>
                    <input type="text" name="age" id="age" class="form-control">
                </div>
                <div class="form-group mt-3">
                    <button type="submit" name="submit" class="btn btn-primary">Enviar</button>
                    <a class="btn btn-primary" href="../index.php">Regresar al inicio</a>
                </div>
            </form>
        </div>
    </div>
<?= createFooter() ?>
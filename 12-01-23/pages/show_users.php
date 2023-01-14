<?php
    require_once "../db_functions.php";
    require_once "../parts/parts.php";

    [
        "error" => $error,
        "sentence" => $sentence,
        "students" => $students
    ] = showStudents();

?>

<?= createHeader() ?>
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

                                    <button class="btn btn-danger">
                                        <a href="./delete.php?userId=<?= $student["id"] ?>">Borrar</a>
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
                <a href="../index.php" class="btn btn-primary mt-4">Regresar al inicio</a>
            </div>
        </div>
    </div>
</div>
<?= createFooter() ?>
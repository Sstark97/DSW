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

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2 class="text-center my-3">Lista de alumnos/as</h2>
            <?php if(count($students) !== 0): ?>
                <table class="table table-bordered table-dark w-75 mx-auto mt-2">
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
                                            <a class="text-decoration-none text-dark" href="./edit.php?userId=<?= $student["id"] ?>"><i class='bx bx-edit-alt'></i></a>
                                        </button>

                                        <button class="btn btn-danger">
                                            <a class="text-decoration-none text-dark" href="./delete.php?userId=<?= $student["id"] ?>"><i class='bx bx-trash-alt'></i></a>
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p class="text-center fs-4 fw-lighter" >No existen estudiantes...</p>
            <?php endif; ?>
        </div>
    </div>

    <div class="container text-center">
        <div class="row">
            <div class="col align-self-center">
                <a href="../index.php" class="btn btn-primary mt-4">Regresar al inicio</a>
            </div>
        </div>
    </div>
</div>
<?= createFooter() ?>
<?php
    require_once "functions.php";

    session_name("tasks");
    session_start();

    $action = $_SERVER["PHP_SELF"]
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Lista de Tareas</title>
</head>
<body>
    <h1 class="text-center mt-3 mb-2">Lista de Tareas</h1>
    <form class="d-flex justify-content-end w-50 mx-auto mt-4" action="<?= $action ?>" method="post">
        <input class="form-control w-75" type="text" placeholder="Nueva tarea..." name="task">
        <button class="btn btn-primary ms-2" type="submit" name="submit">Añadir</button>
    </form>
    <div class="w-50 mx-auto mt-3">
        <?php if(isset($_POST["submit"])) :?>
            <?php addTask() ?>
        <?php endif; ?>

        <?php if(isset($_POST["del_task"])):?>
            <?php deleteTask() ?>
        <?php endif; ?>
        <?= createTable($action) ?>
    </div>
</body>
</html>
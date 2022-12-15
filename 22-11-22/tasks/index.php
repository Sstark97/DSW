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
    <?php if(isset($_POST["submit"])) :?>
        <?php $resolve = addTask() ?>

        <?php if(!empty($resolve)): ?>
            <?= $resolve ?>
        <?php endif; ?>
    <?php endif; ?>
    <form class="d-flex justify-content-end w-50 mx-auto mt-4" action="<?= $action ?>" method="post">
        <input class="form-control w-75" type="text" placeholder="Nueva tarea..." name="task">
        <button class="btn btn-primary ms-2" type="submit" name="submit">Añadir</button>
    </form>
    <div class="w-50 mx-auto mt-3">
        <?php if(isset($_POST["del_task"])):?>
            <?php deleteTask() ?>
        <?php endif; ?>
        <?= createTable($action) ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>
<?php
    require_once "functions.php";

    session_name("login");
    session_start();

    $action = $_SERVER["PHP_SELF"];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>Login</title>
</head>
<body>
    <h1 class="text-center my-3">Login</h1>
    <?php if(isset($_POST["submit"])): ?>
        <?php 
            $_SESSION["user"] = sanitizePost();
            $message = controlErrors();
        ?>

        <?php if (!empty($message)): ?>
            <?= createErrorMsg($message) ?>
            <?= createForm($action) ?>
        <?php else: ?>
            <?= showDataSession() ?>
        <?php endif; ?>
    <?php else: ?>
        <?= createForm($action) ?>
    <?php endif; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>
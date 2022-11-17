<?php
    session_start();

    $_SESSION["name"] = "Aitor";

    session_destroy();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sesion 1</title>
</head>
<body>
    <?php if(isset($_SESSION["name"])) : ?>
        <pre>
            <?= print_r($_SESSION) ?>
        </pre>
    <?php else: ?>
        <p>No existe</p>
    <?php endif;?>
    <a href="./pag02.php">Datos de Sesión</a>
</body>
</html>
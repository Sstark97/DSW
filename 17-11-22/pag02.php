<?php
    session_start(); 
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sesion 2</title>
</head>
<body>
    <?php if(isset($_SESSION["name"])) : ?>
        <pre>
            <?= print_r($_SESSION) ?>
        </pre>
    <?php else: ?>
        <p>No existe</p>
    <?php endif;?>
    <a href="./pag01.php">Vuelve a la página 1</a>
</body>
</html>
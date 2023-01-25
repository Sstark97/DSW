<?php
    session_name("pagina12");
    session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina 14</title>
</head>
<body>
    <p>El nombre es <?= $_SESSION["nombre"]?></p>
    <p>Picha <a href="./pag12.php">aquí</a> para ir a la página 12</p>
</body>
</html>
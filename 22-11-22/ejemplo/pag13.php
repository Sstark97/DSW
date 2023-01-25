<?php
    session_name("pagina13");
    session_start();
    $_SESSION["nombre"] = "Alumno";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página 13</title>
</head>
<body>
    <p>El nombre es <?= $_SESSION["nombre"]?></p>
    <p>Picha <a href="./pag15.php">aquí</a> para ir a la página 15</p>
</body>
</html>
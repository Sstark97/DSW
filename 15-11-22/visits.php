<?php
    setcookie("visits",!isset($_COOKIE["visits"]) ? 1 : $_COOKIE["visits"] + 1)
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visitas</title>
</head>
<body>
    <h1>Visitas <?= $_COOKIE["visits"] ?? 0 ?></h1>
</body>
</html>
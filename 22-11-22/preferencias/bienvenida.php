<?php
    setcookie("preferences", isset($_COOKIE["preferences"]) ? $_COOKIE["preferences"] : serialize([]));

    $preferences = isset($_COOKIE["preferences"]) ? unserialize($_COOKIE["preferences"]) : [];
    if(count($preferences) !== 0) {
        header("Location: index.php");
    }

    [
        "name" => $name, 
        "surname" => $surname, 
        "color" => $color,
        "font_family" => $font_family,
        "lan" => $lan 
    ] = $preferences;
    $welcome = $lan === "es" ? "Bienvenido" : "Welcome";
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grabado de Preferencias (Bienvenida)</title>
</head>
<body>  
    <h1>Preferencias Seleccionadas</h1>
    <div class="w-50 mx-auto">
        <p><?= "$welcome $name"?></p>
        <p>Apellidos: <?= $surname ?></p>
        <p>Color: <?= $color ?></p>
        <p>Fuente: <?= $font_family ?></p>
        <p>Idioma: <?= $lan ?></p>
    </div>
</body>
</html>
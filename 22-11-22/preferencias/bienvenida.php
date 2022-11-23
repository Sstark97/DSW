<?php
    require_once "functions.php";

    $preferences = controlWelcome();

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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <style>
        body {
            background: <?= $color ?>;
            font-family: '<?= $font_family ?>', sans-serif;
        }
    </style>
</head>
<body>  
    <div class="w-50 mx-auto p-3 bg-light mt-4">
        <h1 class="text-center my-3">Preferencias Seleccionadas</h1>
        <p class="text-center fs-4"><?= "$welcome $name $surname"?></p>

        <form class="d-flex justify-content-center" action="<?= $_SERVER["PHP_SELF"] ?>" method="post">
            <button name="del_cookie" class="btn btn-primary" type="submit">Borrar Preferencias</button>
        </form>
    </div>
</body>
</html>
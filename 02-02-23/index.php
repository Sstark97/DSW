<?php
    require_once "functions.php";

    $response = getIslands();
    $islands = $response["islands"];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EA01 - Actividad de E-A</title>
</head>
<body>
    <select id="islands" onchange="villages()">
        <?php foreach($islands as $island): ?>
            <option value="<?= $island["id"] ?>"><?= $island["name"] ?></option>
        <?php endforeach; ?>
    </select>
    <select id="villages" disabled></select> 

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="./main.js"></script>
</body>
</html>
<?php
    setcookie("color",!isset($_POST["submit"]) ? "#fff" : str_replace("%", "#",$_POST["color"]));
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Color de Fondo</title>
</head>
<body style="background: <?= $_COOKIE["color"] ?>">
    <form action="<?= $_SERVER["PHP_SELF"]?>" method="post" >
        <label for="color">Color de Fondo</label>
        <input type="color" name="color" id="color">

        <button name="submit" type="submit">Enviar</button>
    </form>
</body>
</html>
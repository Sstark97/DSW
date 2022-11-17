<?php
    /*
        Generar una página que tenga un formulario, recoja todos
        los valores que pasa el usuario a través de un
        formulario (nombre, apellidos y edad) y cree una cookie 
        denominada datas con todos esos datos.
    */
    setcookie("user",!isset($_POST["submit"]) ? serialize([]) : serialize($_POST["user"]));
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuario Cookies</title>
</head>
<body>

    <form action="<?= $_SERVER["PHP_SELF"]?>" method="post">
        <label for="user[name]">Nombre</label>
        <input type="text" name="user[name]">

        <label for="user[surname]">Apellidos</label>
        <input type="text" name="user[surname]">

        <label for="user[age]">Edad</label>
        <input type="text" name="user[age]">

        <button name="submit" type="submit">Enviar</button>
    </form>

    <?php $user_data = unserialize($_COOKIE["user"]) ?? [];?>
    <?php if(count($user_data) !== 0): ?>
        <h1>Datos de Usuario</h1>
    
        <?php foreach($user_data as $key => $value): ?>
            <div>
                <span><?= $key ?>: </span>
                <span><?= $value ?></span>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
    
</body>
</html>
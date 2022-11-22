<?php
    if(isset($_POST["submit"])) {
        setcookie("preferences", serialize($_POST["preferences"]));
    }

    if(isset($_COOKIE["preferences"]) || isset($_POST["preferences"])) {
        header("Location: bienvenida.php");
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>Grabado de Preferencias (Index)</title>
</head>
<body>
    
    <h1 class="text-center mb-2">Preferencias</h1>
    <form class="w-50 mx-auto" action="<?= $_SERVER["PHP_SELF"]?>" method="post">
        <div class="mb-3">
            <label class="form-label" for="preferences[name]">Nombre</label>
            <input class="form-control" type="text" name="preferences[name]">
        </div>
        <div class="mb-3">
            <label class="form-label" for="preferences[surname]">Apellidos</label>
            <input class="form-control" type="text" name="preferences[surname]">
        </div>
        <div class="mb-3">
            <label class="form-label" for="preferences[color]">Color</label>
            <input class="form-control" type="color" name="preferences[color]">
        </div>
        <div class="mb-3">
            <label class="form-label" for="preferences[font_family]">Letra</label>
            <select name="preferences[font_family]">
                <option value="Times new Romans">Times new Romans</option>
                <option value="Arial">Arial</option>
                <option value="Calibri">Calibri</option>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label" for="preferences[lan]">Idioma</label>
            <select name="preferences[lan]">
                <option value="es">Español</option>
                <option value="en">Ingles</option>
            </select>
        </div>
        <button name="submit" class="btn btn-primary" type="submit">Enviar</button>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>
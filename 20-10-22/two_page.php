<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <title>DSW-UT02-A1 - Formularios</title>
</head>
<body>

    <h1 class="text-center my-2">Generación de Tablas en PHP</h1>
    <form class="container w-50 mx-auto py-3" method="post" action="res_two.php">
        <div>
            <label class="form-label" for="cols">Escriba el número de columnas</label>
            <input class="form-control" type="number" name="cols" id="cols">
        </div>
        <div>
            <label class="form-label" for="rows">Escriba el número de filas</label>
            <input class="form-control" type="number" name="rows" id="rows">
        </div>
        <button class="btn btn-primary my-2" type="submit" name="submit">Enviar</button>
    </form>

    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>
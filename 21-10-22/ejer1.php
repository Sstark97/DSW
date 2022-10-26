<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <title>DSW-UT02-A2-Formularios</title>
</head>
<body>
    <!--
         * Crea un formulario que pida a un usuario un número.
         * Después en otra página recoge ese número y muestra la suma de todos los números pares anteriores a él
         * Por ejemplo si el usuario escribe el número nueve saldría el total de 20  de sumar 2+4+6+8
         * Si el usuario escribe 8, sería 2+4+6 un total de 6
         * Incluir la opción de continuar introduciendo datos.
         */
    -->
    <h1 class="text-center my-3">DSW-UT02-A2-Formularios</h1>
    <form class="w-100 py-4" method="post" action="sum.php">
        <div class="w-25 mx-auto">
            <label class="form-label" for="number">Número</label>
            <input class="form-control" type="number" name="number" id="number" placeholder="Introduce un número" require>
            <button class="btn btn-primary mt-3" type="submit">Enviar</button>
        </div>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>
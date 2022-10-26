<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <title>Tabla Resultado</title>
</head>
<body>

    <?php
        $keys = ["name", "secondname", "surname", "sex", "day", "month", "year", "age", "direction", "dni", "city", "country", "email", "number", "info"];

        $stop = false;
        for ($i = 0; $i < count($_POST); $i ++) {
            $key = $keys[$i];
            if(!isset($_POST["$key"])) {
                $stop = true;
                break;
            }
        }

        if($stop) {
            echo "<h1 class='text-center'>Hay campos vacíos</h1>";
            return;
        }

        echo "<h1 class='text-center py-2'>Información recogida</h1>";
        echo "<table class='table table-bordered table-dark w-50 mx-auto'><tr>";

        foreach($keys as $key) {
            echo "<td>" . str_replace("&", "and", trim(strip_tags($key))) . "</td>";
        }

        echo "<tr>";
        foreach($_POST as $field) {
            echo "<td>"  . str_replace("&", "and", trim(strip_tags($field))) . "</td>";
        }
        echo "</tr></table>";
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>
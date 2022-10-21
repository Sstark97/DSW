<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <title>DSW-UT02-A2-Formularios</title>
</head>
<body>
    <?php
        $number = $_POST["number"] - 1;
        $sum = 0;

        while($number !== 0) {
            if($number % 2 === 0) {
                $sum += $number;
            }

            $number --;
        }

        echo "<h1 class='text-center mt-4'>El Resultado es $sum</h1>"
    ?>
    <div class="d-flex justify-content-center w-100 mt-5">
        <button class="btn btn-primary text-center"><a class="text-light text-decoration-none" href="index.php">Introduce otro valor</a></button>
    </div>


    <!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>UT06 - EA03 - Práctica 03</title>
</head>
<body class="bg-dark text-white">

    <h1 class="text-center my-3">Busca tu Municipio</h1>
    <div class="d-flex justify-content-center mx-auto">
        <input class="w-25 form-control" id="search" type="text" placeholder="Busca Municipios" name="villages" onkeyup="searchVillages()" autofocus>
    </div>
    <div class="d-flex justify-content-center mt-3" id="villages"></div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="main.js"></script>
</body>
</html>
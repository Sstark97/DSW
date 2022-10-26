<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>DSW-UT02-A3-Formularios</title>
</head>
<body>
    
    <h1 class="text-center py-2">Formulario de inscripción Encuentro</h1>
    <form class="container w-50" method="post" action="ejer2_table.php">
        <div class="row">
            <div class="col">
                <p>Nombres y apellidos</p>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <input name="name" id="name" class="form-control" type="text">
                <label for="name">1er Nombre</label>
            </div>
            <div class="col">
                <input name="secondname" id="secondname" class="form-control" type="text">
                <label for="secondname">2do Nombre</label>
            </div>
            <div class="col">
                <input name="surname" id="surname" class="form-control" type="text">
                <label for="surname">Apellidos</label>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <p>Sexo</p>
            </div>
        </div>
        <div class="row ms-4">
            <div class="col form-check">
                <input class="form-check-input" type="radio" name="sex" id="sex1" value="hombre">
                <label class="form-check-label" for="sex1">
                    Hombre
                </label>
                </div>
                <div class="form-check">
                <input class="form-check-input" type="radio" name="sex" id="sex2">
                <label class="form-check-label" for="sex2">
                    Mujer
                </label>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col">
                <p>Fecha de Nacimiento</p>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <input name="day" id="day" class="form-control" type="text">
                <label for="secondname">Día</label>
            </div>
            <div class="col">
                <input name="month" id="month" class="form-control" type="text">
                <label for="month">Mes</label>
            </div>
            <div class="col">
                <input name="year" id="year" class="form-control" type="text">
                <label for="year">Año</label>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col">
                <p>Edad</p>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <input name="age" id="age" class="form-control" type="number">
            </div>
        </div>

        <div class="row mt-3">
            <div class="col">
                <p>Dirección <span class="text-danger">*</span></p>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <input name="direction" class="form-control" type="text">
            </div>
        </div>

        <div class="row my-2">
            <div class="col">
                <input name="dni" id="dni" class="form-control" type="text">
                <label for="dni">Documento de Identidad</label>
            </div>
            <div class="col">
                <input name="city" id="city" class="form-control" type="text">
                <label for="city">Ciudad</label>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col">
                <select class="form-select" name="country">
                    <option disabled selected value> -- Selecciona una opción -- </option>
                    <option value="España">España</option>
                    <option value="Portugal">Portugal</option>
                    <option value="Francia">Francia</option>
                    <option value="Italia">Italia</option>
                    <option value="Alemania">Alemania</option>
                </select>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col">
                <input name="email" id="email" class="form-control" type="email" require>
                <label for="email">Correo Electrónico<span class="text-danger">*</span></label>
            </div>
            <div class="col">
                <input name="number" id="number" class="form-control" type="tel">
                <label for="number">Móvil</label>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col d-flex align-items-center">
                <input name="info" class="me-2" type="checkbox" name="info" id="info">
                <label for="info">Deseo recibir información</label>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col">
                <button class="btn btn-danger">GUARDAR</button>
            </div>
        </div>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>
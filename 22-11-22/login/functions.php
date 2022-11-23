<?php

define("correct_pass", "A1s2d3f4g5");
define("fields", ["name", "surname", "password"]);

function createForm ($action) {
    $user = $_SESSION["user"] ?? [];
    $name = $user["name"] ?? "";
    $surname = $user["surname"] ?? "";

    return <<< END
    <form class="w-50 mx-auto mt-3" action="$action" method="post">
        <div class="mb-3">
            <label class="form-label" for="user[name]">Nombre</label>
            <input class="form-control" type="text" name="user[name]" value="$name" required>
        </div>
        <div class="mb-3">
            <label class="form-label" for="user[surname]">Apellidos</label>
            <input class="form-control" type="text" name="user[surname]" value="$surname" required>
        </div>
        <div class="mb-3">
            <label class="form-label" for="user[name]">Contraseña</label>
            <input class="form-control" type="password" name="user[password]" required>
        </div>
        <button type="submit" name="submit" class="btn btn-primary mt-2">Enviar</button>
    </form>
    END;
}

function checkPass () {
    ["password" => $password] = $_SESSION["user"];

    return strcmp(correct_pass, $password) === 0;
}

function controlFields () {
    $message = "";

    if(!isset($_SESSION["user"]) || count($_SESSION["user"]) !== count(fields)) {
        $message .= "<p>Sobran/Faltan campos</p>";
    } else {
        $session_keys = $_POST["user"] ? array_keys($_SESSION["user"]) : [];
        for ($i = 0; $i < count(fields); $i ++) {
            if(strcmp($session_keys[$i], fields[$i]) !== 0) {
                $message .= "<p>Los campos no coinciden</p>";
                break;
            }
        }
    }

    return $message;
}

function isEmptyFields () {
    [
        "name" => $name, 
        "surname" => $surname, 
        "password" => $password
    ] = $_SESSION["user"];
    $message = "";

    if(empty($name) || empty($surname)) {
        $message .= "<p>Hay campos vacios</p>";
    } else if(!checkPass()) {
        $message .= "<p>La contraseña es incorrecta</p>";
    }

    return $message;
}

function createErrorMsg (string $message) {
    return <<< END
        <div class="w-50 mx-auto mb-2 alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> $message
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    END;
}

function controlErrors () {
    return empty(controlFields()) ? isEmptyFields() : controlFields();
}

function sanitizePost () {
    $user = $_POST["user"] ?? [];
    $name = $user["name"] ?? "";
    $surname = $user["surname"] ?? "";
    $password = $user["password"] ?? "";

    $user = [
        "name" => trim(strip_tags($name)), 
        "surname" => trim(strip_tags($surname)),
        "password" => trim(strip_tags($password))
    ];

    return $user;
}

function showDataSession () {
    ["name" => $name, "surname" => $surname] = $_SESSION["user"];

    return <<< END
        <div class="d-flex flex-column justify-content-center mt-1 mx-auto w-50">
            <h2 class="text-center">Datos de Sesión</h2>¡
            <p>Nombre: $name</p>
            <p>Apellidos: $surname</p>
        </div>
    END;
}
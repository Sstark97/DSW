<?php

/**
 * Función que renderiza el enlace  a la página
 * donde ver todos los juegos
 */
function renderNav () {
    $is_admin = $_SESSION["is_admin"];
    $browse = !$is_admin ? "<li><a href='browse.php'>Browse</a></li>" : "";

    return <<< END
        <li><a href="index.php" class="active">Home</a></li>
        $browse
    END;
}

/**
 * Función que te redirige a inicio en
 * caso de que el id del usuario se
 * encuentre en la sesión
 */
function isLogged () {
    if (isset($_SESSION["userId"])) {
        header("Location: ../index.php");
    }
}

/**
 * Función que destruye la sesión y te redirje
 * al login
 */
function logout () {
    session_destroy();

    redirect("./pages/login.php");
}

/**
 * Función que te redirige al login en
 * caso de que el id del usuario se
 * no encuentre en la sesión
 */
function isNotLogged () {
    if (!isset($_SESSION["userId"])) {
        header("Location: ./pages/login.php");
    }
}

function redirect(string $location) {
    header("Location: $location");
    exit();
}

// Función que crea los errores a mostrar
function createErrors(string $message, bool $empty = false)
{
    $message = $empty ? "<span>$message</span>" : $message;

    return <<< END
        <div id="errors" class="d-flex flex-column align-items-center w-50 mx-auto fw-3 pt-3 text-white">
            <p class='m-0 mb-2'>Hay Errores 🐛</p>
            $message
        </div>
    END;
}

// Función que valida si hay campos de más o de menos
function comprobeFields(array $to_comprobe, array $keys)
{
    /*
    Comprobamos si hay diferencias en lo que
    nos llega con lo que debería llegar
     */
    $diff = count(array_diff(array_keys($to_comprobe), $keys));
    if ($diff !== 0) {
        return true;
    }

    // Comprobamos si hay valores vacíos
    $size_keys = count($keys);
    $stop = false;

    for ($i = 0; $i < $size_keys; $i++) {
        $key = $keys[$i];

        if (empty($to_comprobe[$key])) {
            $stop = true;
            break;
        }
    }

    return $stop;
}

// Función que sanea los datos que nos llegan
function sanitizeFields(array $fields)
{
    $sanitize_fields = [];

    foreach ($fields as $key => $field) {
        $sanitize_field = $key !== "email" ? trim(strip_tags($field)) : trim(strip_tags(filter_var($field, FILTER_SANITIZE_EMAIL)));

        array_push($sanitize_fields, $sanitize_field);
    }

    return $sanitize_fields;
}

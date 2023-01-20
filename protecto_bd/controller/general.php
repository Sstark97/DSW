<?php
// Función que crea los errores a mostrar
function createErrors (string $message, bool $empty = false) {
    $message = $empty ? "<span>$message</span>" : $message;

    return <<< END
        <div id="errors" class="d-flex flex-column align-items-center w-50 mx-auto fw-3 pt-3 text-white">
            <p class='m-0 mb-2'>Hay Errores 🐛</p>
            $message
        </div>
    END;
}

// Función que sanea los datos que nos llegan
function sanitizeFields () {
    [
        "dni" => $dni, 
        "name" => $name,
        "surname" => $surname, 
        "email" => $email,
        "phone" => $phone,
        "age" => $age,
        "password" => $password
    ] = $_POST["user"];

    $dni = trim(strip_tags($dni));
    $name = trim(strip_tags($name));
    $surname = trim(strip_tags($surname));
    $email = trim(strip_tags(filter_var($email, FILTER_SANITIZE_EMAIL)));
    $phone = trim(strip_tags($phone));
    $age = trim(strip_tags($age));
    $password = trim(strip_tags($password));

    return [$dni, $name, $surname, $email, $phone, $age, $password];
}

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

// Función que valida si hay campos de más o de menos
function comprobeFields (array $to_comprobe, array $keys) {
    /*
        Comprobamos si hay diferencias en lo que 
        nos llega con lo que debería llegar
    */
    $diff = count(array_diff(array_keys($to_comprobe), $keys));
    if($diff !== 0) {
        return true;
    }

    // Comprobamos si hay valores vacíos
    $size_keys = count($keys);
    $stop = false;

    for ($i = 0; $i < $size_keys; $i ++) {
        $key = $keys[$i];

        if(empty($to_comprobe[$key])) {
            $stop = true;
            break;
        }
    }

    return $stop;
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
    $hash_password = password_hash($password, PASSWORD_BCRYPT, ["salt" => "my_secret_hash_password", "cost" => 15]);

    return [$dni, $name, $surname, $email, $phone, $age, $hash_password];
}

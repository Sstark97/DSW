<?php
require_once "general.php";

// Función que valida si hay campos de más o de menos
function comprobeFields () {
    $user = $_POST["user"];
    $keys = ["dni","name","surname", "email", "phone", "age", "password"];

    /*
        Comprobamos si hay diferencias en lo que 
        nos llega con lo que debería llegar
    */
    $diff = count(array_diff(array_keys($user), $keys));
    if($diff !== 0) {
        return true;
    }


    // Comprobamos si hay valores vacíos
    $size_keys = count($keys);
    $stop = false;

    for ($i = 0; $i < $size_keys; $i ++) {
        $key = $keys[$i];

        if(empty($user[$key])) {
            $stop = true;
            break;
        }
    }

    return $stop;
}

// Función donde se realizan las validaciones de los datos si no están vacíos
function validateRegisterForm () {
    $message = "";
    [
        "dni" => $dni, 
        "name" => $name,
        "surname" => $surname, 
        "email" => $email,
        "phone" => $phone,
        "age" => $age,
        "password" => $password
    ] = $_POST["user"];

    if(!preg_match("/\d{8}[A-Z]{1}/", $dni) || strlen($dni) !== 9) {
        $message .= "<p class='m-0 mb-2'>El dni no cumple con el formato 12345678[A-Z] (8 números y 1 letra)</p>";
    }
    
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message .= "<p class='m-0 mb-2'>El correo no cumple el formato, Ej: correo@correo.com</p>";
    }

    if(!preg_match("/\d{9}/",$phone) || strlen($phone) !== 9) {
        $message .= "<p class='m-0 mb-2'>El Telefono no tiene 9 dígitos</p>";
    }

    if(!filter_var($age, FILTER_VALIDATE_INT)) {
        $message .= "<p class='m-0 mb-2'>La edad no es un entero</p>";
    }

    if(!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/",$password) || strlen($password) !== 9) {
        $message .= "<p class='m-0 mb-2'>La contraseña debe tener minimo 8 carácteres, al menos 1 mayúscula, 1 minúscula y 1 número</p>";
    }
    
    return $message;
}

// Función en la que se crea el usurio el Usuario
function createUser() {
    [
        $sanitize_dni, 
        $sanitize_name, 
        $sanitize_surname, 
        $sanitize_birth_day, 
        $sanitize_phone, 
        $sanitize_email 
    ]= sanitizeFields();

    $birthday_date = date_create_from_format('Y-m-d',$sanitize_birth_day);
    $timestamp_insert = date_timestamp_get($birthday_date);

    $user = [
            "name" => $sanitize_name,
            "surname" => $sanitize_surname, 
            "birth_day" => $sanitize_birth_day, 
            "phone" => $sanitize_phone, 
            "email" => $sanitize_email,
            "block" => false,
            "files" => [],
            "timestamp_insert" => $timestamp_insert
    ];

    return [ $sanitize_dni, $user ];
}

// Función que comprueba los errores y realiza la acción de registro
function registerAction () {
    $is_ok = comprobeFields();
    $message = $is_ok ? createErrors("Existen campos vacíos o campos de más", true) : validateRegisterForm();

    if(empty($message) && !$is_ok ) {
        echo "Correcto";
    } else if(!empty($message) && !$is_ok) {
        $message = createErrors($message);
    }

    return $message;
}
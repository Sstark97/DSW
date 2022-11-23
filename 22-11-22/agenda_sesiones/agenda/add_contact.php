<?php
require_once "general_functions.php";

/*
    Formulario en el que se visualiza sin poder editar 
    los datos que se han pasado del formulario de inserción
    o edición
*/ 
function sendContactDataForm (string $message, array $contacts, array $contact, string $action) {

    $form = contactForm($message, "send_data", $action, $contact, true, true);

    return $form;
}

// Función que valida si hay campos de más o de menos
function comprobeFields () {
    $contact = $_POST["contact"];
    $keys = ["dni","name","surname", "phone", "birthday", "email"];

    /*
        Comprobamos si hay diferencias en lo que 
        nos llega con lo que debería llegar
    */
    $diff = count(array_diff(array_keys($contact), $keys));
    if($diff !== 0) {
        return true;
    }


    // Comprobamos si hay valores vacíos
    $size_keys = count($keys);
    $stop = false;

    for ($i = 0; $i < $size_keys; $i ++) {
        $key = $keys[$i];

        if(empty($contact[$key])) {
            $stop = true;
            break;
        }
    }

    return $stop;
}

// Función donde se realizan las validaciones de los datos si no están vacíos
function validateAddUserForm () {
    $message = "";
    [
        "dni" => $dni, 
        "name" => $name,
        "surname" => $surname, 
        "birthday" => $birth_day, 
        "phone" => $phone, 
        "email" => $email
    ] = $_POST["contact"];

    if(!preg_match("/\d{8}[A-Z]{1}/", $dni) || strlen($dni) !== 9) {
        $message .= "<span>El dni no cumple con el formato 12345678[A-Z] (8 números y 1 letra)</span>";
    }

    if(!preg_match("/\d{9}/",$phone) || strlen($phone) !== 9) {
        $message .= "<span>El Telefono no tiene 9 dígitos</span>";
    }

    if(!preg_match("/\d{4}[-](0[1-9]|1[012])[-](0[1-9]|[12]\d|3[01])/",$birth_day)) {
        $message .= "<span>La fecha de cumpleaños no cumple con el formato de Fecha</span>";
    }

    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message .= "<span>El correo no cumple el formato, Ej: correo@correo.com</span>";
    }

    return $message;
}

// Función donde creamos el contacto
function createContact() {
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

    $contact = [
            "name" => $sanitize_name,
            "surname" => $sanitize_surname, 
            "birth_day" => $sanitize_birth_day, 
            "phone" => $sanitize_phone, 
            "email" => $sanitize_email,
            "block" => false,
            "files" => [],
            "timestamp_insert" => $timestamp_insert
    ];

    return [ $sanitize_dni, $contact ];
}
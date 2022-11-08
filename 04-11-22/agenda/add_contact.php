<?php
require_once "general_functions.php";

function sendContactDataForm (string $message, array $contacts, array $contact, string $action) {
    $json_contacts = json_encode($contacts);


    $form = contactForm($message, "send_data", $action, $contacts, $contact, true, true);

    return $form;
}

function comprobeFields (array $contact) {
    $keys = ["dni","name","surname", "phone", "birthday", "email"];
    $size_keys = count($keys);
    $diff = count(array_diff(array_keys($contact), $keys));
    $stop = false;

    if($diff !== 0) {
        return true;
    }

    for ($i = 0; $i < $size_keys; $i ++) {
        $key = $keys[$i];

        if(empty($contact[$key])) {
            $stop = true;
            break;
        }
    }

    return $stop;
}

function validateAddUserForm (string $dni = "", string $name = "", string $surname = "", string $birth_day = "", string $phone = "", string $email = "") {
    $message = "";

    if(!preg_match("/\d{8}[A-Z]{1}/", $dni)) {
        $message .= "<p>El dni no cumple con el formato 123456789[A-Z]</p>";
    }

    if(!preg_match("/\d{9}/",$phone)) {
        $message .= "<p>El Telefono no tiene 9 dígitos</p>";
    }

    if(!preg_match("/\d{4}[-](0[1-9]|1[012])[-](0[1-9]|[12]\d|3[01])/",$birth_day)) {
        $message .= "<p>La fecha de cumpleaños no cumple con el formato de Fecha</p>";
    }

    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message .= "<p>El correo no cumple el formato, Ej: correo@correo.com</p>";
    }

    return $message;
}

function createContact(string $dni = "", string $name = "", string $surname = "", string $birth_day = "", string $phone = "", string $email = "") {

    [
        $sanitize_dni, 
        $sanitize_name, 
        $sanitize_surname, 
        $sanitize_birth_day, 
        $sanitize_phone, 
        $sanitize_email 
    ]= sanitizeFields($dni, $name, $surname, $birth_day, $phone, $email);

    $birthday_date = date_create_from_format('Y-m-d',$birth_day);
    $timestamp_insert = date_timestamp_get($birthday_date);

    $contact = [
            "name" => $sanitize_name,
            "surname" => $sanitize_surname, 
            "birth_day" => $sanitize_birth_day, 
            "phone" => $sanitize_phone, 
            "email" => $sanitize_email,
            "block" => false,
            "timestamp_insert" => $timestamp_insert
    ];

    return [ $sanitize_dni, $contact ];
}
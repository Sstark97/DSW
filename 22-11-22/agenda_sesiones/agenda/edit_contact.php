<?php
require_once "general_functions.php";

// Función que devuelve el formulario de Edición 
function editContactForm (string $action, array $contacts) {
    $dni = $_POST["contact_dni"];
    $contact = $contacts[$dni];
    [ "name" => $name ] = $contact;

    return contactForm("Editar Contacto ($name)", "action[edit]", $action, $contacts, $contact = [$dni => $contact]);
}

// Función que edita el contacto
function editContact(int $timestamp_insert, array &$contacts) {
    [
        $sanitize_dni, 
        $sanitize_name, 
        $sanitize_surname, 
        $sanitize_birth_day, 
        $sanitize_phone, 
        $sanitize_email 
    ]= sanitizeFields();

    $blocked = false;
    $files = [];

    // Si cambia de DNI eliminas el antiguo y guardas sus ficheros y su estado de bloqueo
    foreach ($contacts as $dni => $contact) {
        
        if(($dni !== $sanitize_dni || $dni === $sanitize_dni) && $contact["timestamp_insert"] === $timestamp_insert) {
            $blocked = $contact["block"];
            $files = $contact["files"];
            unset($contacts[$dni]);
        }
    }

    $contact = [
        "name" => $sanitize_name,
        "surname" => $sanitize_surname, 
        "birth_day" => $sanitize_birth_day, 
        "phone" => $sanitize_phone, 
        "email" => $sanitize_email,
        "block" => $blocked,
        "files" => $files,
        "timestamp_insert" => $timestamp_insert
    ];

    return [ $sanitize_dni, $contact ];
}
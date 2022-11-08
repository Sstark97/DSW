<?php
require_once "general_functions.php";

function editContactForm (string $action, string $dni, array $contacts) {
    $contact = json_decode($contacts[$dni],true);
    [ "name" => $name ] = $contact;

    return contactForm("Editar Contacto ($name)", "action[edit]", $action, $contacts, $contact = [$dni => $contact]);
}

function editContact(int $timestamp_insert, array &$contacts, string $dni = "", string $name = "", string $surname = "", string $birth_day = "", string $phone = "", string $email = "") {

    [
        $sanitize_dni, 
        $sanitize_name, 
        $sanitize_surname, 
        $sanitize_birth_day, 
        $sanitize_phone, 
        $sanitize_email 
    ]= sanitizeFields($dni, $name, $surname, $birth_day, $phone, $email);

    $blocked = false;

    foreach ($contacts as $dni => $contact) {
        $contact = json_decode($contact, true);
        
        if(($dni !== $sanitize_dni || $dni === $sanitize_dni) && $contact["timestamp_insert"] === $timestamp_insert) {
            $blocked = $contact["block"];
            unset($contacts[$dni]);
        }
    }

    $contact = [
        "$sanitize_dni" => [
            "name" => $sanitize_name,
            "surname" => $sanitize_surname, 
            "birth_day" => $sanitize_birth_day, 
            "phone" => $sanitize_phone, 
            "email" => $sanitize_email,
            "block" => $blocked,
            "timestamp_insert" => $timestamp_insert
        ]
    ];

    return $contact;
}
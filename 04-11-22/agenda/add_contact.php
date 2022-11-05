<?php

function createAddUserForm(string $action) {
    return <<< END
        <h1 class="text-center mt-2">Añadir contacto</h1>
        <form class="w-50 container mx-auto" action="$action" method="post">
            <div class="row">
                <div class="col">
                    <label for="contact[dni]" class="form-label">DNI</label>
                    <input type="text" class="form-control" name="contact[dni]">
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label for="contact[name]" class="form-label">Nombre</label>
                    <input type="text" class="form-control" name="contact[name]">
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label for="contact[surname]" class="form-label">Apellidos</label>
                    <input type="text" class="form-control" name="contact[surname]">
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label for="contact[birthday]" class="form-label">Fecha de Nacimiento</label>
                    <input type="date" class="form-control" name="contact[birthday]">
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label for="contact[phone]" class="form-label">Teléfono</label>
                    <input type="tel" class="form-control" name="contact[phone]">
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label for="contact[email]" class="form-label">Email</label>
                    <input type="email" class="form-control" name="contact[email]">
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <button name="add_form" class="btn btn-primary" type="submit">Añadir</button>
                </div>
            </div>
        </form>
    END;
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

function sanitizeAddContactFields (string $dni = "", string $name = "", string $surname = "", string $birth_day = "", string $phone = "", string $email = "") {
    $dni = trim(strip_tags($dni));
    $name = trim(strip_tags($name));
    $surname = trim(strip_tags($surname));
    $birth_day = trim(strip_tags($birth_day));
    $phone = trim(strip_tags($phone));
    $email = trim(strip_tags(filter_var($email, FILTER_SANITIZE_EMAIL)));

    return [$dni, $name, $surname, $birth_day, $phone, $email];
}

function createContact(string $dni = "", string $name = "", string $surname = "", string $birth_day = "", string $phone = "", string $email = "") {

    [
        $sanitize_dni, 
        $sanitize_name, 
        $sanitize_surname, 
        $sanitize_birth_day, 
        $sanitize_phone, 
        $sanitize_email 
    ]= sanitizeAddContactFields($dni, $name, $surname, $birth_day, $phone, $email);

    $birthday_date = date_create($birth_day);
    $timestamp_insert = date_timestamp_get($birthday_date);

    $contact = [
        $sanitize_dni => [
            "name" => $sanitize_name,
            "surname" => $sanitize_surname, 
            "birth_day" => $sanitize_birth_day, 
            "phone" => $sanitize_phone, 
            "email" => $sanitize_email,
            "timestamp_insert" => $timestamp_insert
        ]
    ];

    return $contact;
}
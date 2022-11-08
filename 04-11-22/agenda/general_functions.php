<?php
require_once "./agenda/add_contact.php";
require_once "./agenda/edit_contact.php";

function contactForm(string $message, string $btn_name, string $action, array $contacts, array $contact = [], bool $is_read = false, bool $show = false) {
    $json_contacts = json_encode($contacts);
    $dni = ""; 
    $name = ""; 
    $surname = ""; 
    $birth_day = ""; 
    $phone = ""; 
    $email = "";

    if(count($contact) > 0) {
        $dni = array_keys($contact)[0];
        [
            "name" => $name, 
            "surname" => $surname, 
            "birth_day" => $birth_day, 
            "phone" => $phone, 
            "email" => $email,
            "timestamp_insert" => $timestamp_insert
        ]= $contact[$dni];
    }

    $read = $is_read ? "readonly" : "";
    $is_show = !$show ? '<input type="hidden" name="not_show">' : "";
    $is_edit = $btn_name === "action[edit]" ? "<input type='hidden' name='timestamp_insert' value='$timestamp_insert'>" : "";

    return <<< END
        <h1 class="text-center mt-2">$message</h1>
        <form class="w-50 container mx-auto" action="$action" method="post">
            <div class="row">
                <div class="col">
                    <label for="contact[dni]" class="form-label">DNI</label>
                    <input type="text" class="form-control" name="contact[dni]" value="$dni" $read>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label for="contact[name]" class="form-label">Nombre</label>
                    <input type="text" class="form-control" name="contact[name]" value="$name" $read>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label for="contact[surname]" class="form-label">Apellidos</label>
                    <input type="text" class="form-control" name="contact[surname]" value="$surname" $read>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label for="contact[birthday]" class="form-label">Fecha de Nacimiento</label>
                    <input type="date" class="form-control" name="contact[birthday]" value="$birth_day" $read>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label for="contact[phone]" class="form-label">Teléfono</label>
                    <input type="tel" class="form-control" name="contact[phone]" value="$phone" $read>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label for="contact[email]" class="form-label">Email</label>
                    <input type="email" class="form-control" name="contact[email]" value="$email" $read>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <button name="$btn_name" class="btn btn-primary" type="submit">Enviar</button>
                </div>
            </div>
            <input type="hidden" name="contacts" value='$json_contacts'>
            $is_edit
            $is_show
        </form>
    END;
}

function modifyAction(bool $is_edit, int $time_stamp, array &$contacts, array $post_values) {
    $data = $is_edit ? createContact(...$post_values) : editContact($time_stamp, $contacts, ...$post_values);
    [ $dni, $contact ] = $data; 
    $contacts[$dni] = $contact;

    return [ $dni, $contact ];
}

function sanitizeFields (string $dni = "", string $name = "", string $surname = "", string $birth_day = "", string $phone = "", string $email = "") {
    $dni = trim(strip_tags($dni));
    $name = trim(strip_tags($name));
    $surname = trim(strip_tags($surname));
    $birth_day = trim(strip_tags($birth_day));
    $phone = trim(strip_tags($phone));
    $email = trim(strip_tags(filter_var($email, FILTER_SANITIZE_EMAIL)));

    return [$dni, $name, $surname, $birth_day, $phone, $email];
}

function formatTimeStamp (int $time_stamp) {
    $time = strtolower(strftime("%p",$time_stamp));

    setlocale(LC_ALL,"es", "ES", "es_ES.UTF-8");
    
    $day = ucwords(strftime("%A, %d",$time_stamp));
    $month = ucwords(strftime("%B",$time_stamp));
    $year = strftime("%G",$time_stamp);
    $hour = strftime("%I:%M:%S",$time_stamp);
    
    return "$day de $month de $year, $hour $time";
}
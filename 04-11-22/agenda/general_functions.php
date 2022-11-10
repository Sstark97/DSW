<?php
require_once "./agenda/add_contact.php";
require_once "./agenda/edit_contact.php";
require_once "./agenda/block_contact.php";
require_once "./agenda/files_contact.php";

function showTable() {
    return !isset($_POST["not_show"]) && !isset($_POST["order_action"]) && !isset($_POST["action"]) && !isset($_POST["block_action"]) && !isset($_POST["upload_action"]);
}

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
    $btn_color = $btn_name === "action[edit]" ? "warning" : "primary";

    return <<< END
        <h1 class="text-center mt-2">$message</h1>
        <form class="w-50 container mx-auto pt-3" action="$action" method="post">
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
            <div class="row mt-3">
                <div class="col">
                    <button name="$btn_name" class="btn btn-$btn_color" type="submit">Enviar</button>
                </div>
            </div>
            <input type="hidden" name="contacts" value='$json_contacts'>
            $is_edit
            $is_show
        </form>
    END;
}

function createErrors (string $message, bool $empty = false) {
    $message = $empty ? "<span>$message</span>" : $message;

    return <<< END
        <div id="errors" class="d-flex flex-column align-items-center w-50 mx-auto mt-3 fw-4">
            <h1 class="mb-2">Hay errores 🐛</h1>
            $message
        </div>
    END;
}

function isModify() {
    return isset($_POST["add_form"]) || isset($_POST["action"]["edit"]);
}

function modifyAction(bool $is_edit, int $time_stamp, array &$contacts) {
    $data = $is_edit ? createContact() : editContact($time_stamp, $contacts);
    [ $dni, $contact ] = $data; 
    $contacts[$dni] = $contact;

    return [ $dni, $contact ];
}

function sanitizeFields () {
    [
        "dni" => $dni, 
        "name" => $name, 
        "surname" => $surname, 
        "birthday" => $birth_day, 
        "phone" => $phone, 
        "email" => $email
    ] = $_POST["contact"];

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
    
    return utf8_encode("$day de $month de $year, $hour $time");
}

function actions (string $action, array $contacts) {
    $action = "";
    if (isset($_POST["action"]["add"])){
        $action .= contactForm("Añadir Contacto","add_form",$action, $contacts);
    } else if (isset($_POST["action"]["update"])){
        $action .= editContactForm($action, $contacts);
    } else if (isset($_POST["action"]["block"])){
        $action .= blockContactForm($action, $contacts);
    } else if (isset($_POST["action"]["upload"])){
        $action .= uploadForm($action ,$contacts);
    }  

    return $action;
}

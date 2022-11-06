<?php
function contactForm(string $message, string $btn_name, string $action, array $contacts, array $contact = [], bool $is_read = false) {
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
        ]= $contact[$dni];
    }

    $read = $is_read ? "readonly" : "";
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
        </form>
    END;
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
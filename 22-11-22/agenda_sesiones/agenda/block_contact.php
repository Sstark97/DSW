<?php
require_once "./agenda/general_functions.php";

// Formulario de bloqueo de los contactos
function blockContactForm (string $action) {

    return <<< END
    <h1 class="text-center mt-2">Bloquear Contacto</h1>
    <form class="d-flex justify-content-end w-50 mx-auto mt-4" action="$action" method="post">
        <input class="form-control" type="text" name="block_dni" placeholder="Escribe el dni de la persona">
        <button name="block_action" class="btn btn-primary ms-1">Bloquear</button>
    </form>
    END;
}

// Función que comprueba si el contacto existe o está bloqueado
function comprobeBlockContact (string $block_dni, array $contacts) {
    $message = "";
    $contact = isset($contacts[$block_dni]) ? $contacts[$block_dni] : [];

    if(count($contact) === 0) {
        $message .= "<span>No tienes ese contacto</span>";
    } else if($contact["block"]) {
        $message .= "<span>El contacto ya está bloqueado</span>";
    }

    return $message;
}

// Función que realiza la acción de bloquear el contacto
function blockContact (string $block_dni, array &$contacts) {
    $message = comprobeBlockContact($block_dni, $contacts);

    if(!empty($message)) {
        return [ false, createErrors($message) ];
    }
    $contact = $contacts[$block_dni];
    unset($contacts[$block_dni]);

    $contact["block"] = true;
    [ "name" => $name ] = $contact;
    $contacts[$block_dni] = $contact;

    $_SESSION["contacts"] = $contacts;

    return [ true, "<span class='my-3'>El contacto $name($block_dni) ha sido bloqueado con éxito</span>" ];
}

/*
    Formulario en el que se visualiza el contacto
    a bloquear, y pregunta si estas seguro de 
    realizar la acción
*/ 
function sendBlockContact (string $action, array &$contacts) {
    $block_dni = $_POST["block_dni"];
    [ $is_ok, $message ] = blockContact($block_dni, $contacts);
    $json_contacts = json_encode($contacts);
    $okey_message = <<< END
        <div class="d-flex flex-column align-items-center w-75 mx-auto mt-3 fw-4">
            <h1 class="text-center mt-2">Bloquear Contacto</h1>
            $message
            <span class="mb-3">¿Estas de seguro de que quieres bloquear a el contacto $block_dni 🤔?</span>
            <button name="send_data" class="btn btn-primary ms-1">Bloquear</button>
        </div>
    END;

    $message = $is_ok ? $okey_message : $message;

    return <<< END
        <form class="d-flex flex-column align-items-start w-50 mx-auto mt-4" action="$action" method="post">
            $message
            <input type="hidden" name="contacts" value='$json_contacts'>
        </form>
    END;
}
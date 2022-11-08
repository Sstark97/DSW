<?php

function blockContactForm (string $action, array $contacts) {
    $json_contacts = json_encode($contacts);

    return <<< END
    <h1 class="text-center mt-2">Bloquear Contacto</h1>
    <form class="d-flex justify-content-end w-50 mx-auto mt-4" action="$action" method="post">
        <input class="form-control" type="text" name="block_dni" placeholder="Escribe el dni de la persona">
        <input type="hidden" name="contacts" value='$json_contacts'>
        <button name="block_action" class="btn btn-primary ms-1">Bloquear</button>
    </form>
    END;
}

function comprobeBlockContact (string $block_dni, array $contacts) {
    $message = "";
    $contact = isset($contacts[$block_dni]) ? json_decode($contacts[$block_dni], true) : [];

    if(count($contact) === 0) {
        $message .= "<p>No tienes ese contacto</p>";
    } else if($contact["block"]) {
        $message .= "<p>El contacto ya está bloqueado</p>";
    }

    return $message;
}

function blockContact (string $block_dni, array $contacts) {
    $message = comprobeBlockContact($block_dni, $contacts);

    if(!empty($message)) {
        return [ false, $message ];
    }
    $contact = json_decode($contacts[$block_dni], true);
    unset($contacts[$block_dni]);

    $contact["block"] = true;
    [ "name" => $name ] = $contact;
    $contacts[$block_dni] = json_encode($contact);

    return [ true, "<p>El contacto $name($block_dni) ha sido bloqueado con éxito</p>" ];
}

function sendBlockContact (string $action, string $block_dni, array &$contacts) {
    $json_contacts = json_encode($contacts);
    [ $is_ok, $message ] = blockContact($block_dni, $contacts);

    $submit = $is_ok ? '<button name="send_data" class="btn btn-primary ms-1">Bloquear</button>' : '';

    return <<< END
        <h1 class="text-center mt-2">Bloquear Contacto</h1>
        <form class="d-flex flex-column align-items-start w-50 mx-auto mt-4" action="$action" method="post">
            <p>$message</p>
            <input type="hidden" name="contacts" value='$json_contacts'>
            $submit
        </form>
    END;
}
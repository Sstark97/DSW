<?php

function uploadForm(string $action, string $dni, array $contacts) {
    $json_contacts = json_encode($contacts);

    return <<< END
    <h1 class="text-center mt-2">Bloquear Contacto</h1>
    <form class="d-flex justify-content-end w-50 mx-auto mt-4" action="$action" method="post" enctype="multipart/form-data">
        <input class="form-control" type="file" name="file_dni">
        <input type="hidden" name="contacts" value='$json_contacts'>
        <button name="upload_action" class="btn btn-primary ms-1">Subir</button>
    </form>
    END;
}

function comprobeFile(string $file_dni, array $files) {
    ["file_dni" => $file] = [$file_dni];
    $message = "";
}
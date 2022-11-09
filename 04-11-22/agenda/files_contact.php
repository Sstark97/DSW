<?php
define("file_types", ["application/pdf", "application/vnd.oasis.opendocument.text"]);

function uploadForm(string $action, string $dni, array $contacts) {
    $json_contacts = json_encode($contacts);

    return <<< END
    <h1 class="text-center mt-2">Bloquear Contacto</h1>
    <form class="d-flex justify-content-end w-50 mx-auto mt-4" action="$action" method="post" enctype="multipart/form-data">
        <input type="hidden" name="MAX_FILE_SIZE" value="1000000">
        <input class="form-control" type="file" name="file_dni">
        <input type="hidden" name="contact_dni" value='$dni'>
        <input type="hidden" name="contacts" value='$json_contacts'>
        <button name="upload_action" class="btn btn-primary ms-1">Subir</button>
    </form>
    END;
}

function comprobeFile(array $file) {
    ["error" => $error, "type" => $type] = $file;
    $message = "";

    if($error === 2) {
        $message .= "<p>El tamaño máximo de subida es 1000 MB</p>";
    } 
    
    if(!in_array($type, file_types)){
        $message .= "<p>La agenta solo soporta ficheros en formato odt y pdf</p>";
    } 

    return $message;
}

function uploadFile(string $dni, array $file) {
    $message = comprobeFile($file);

    if(!empty($message)) {
        return $message;
    }

    $user_dir = "./agenda/files/$dni";
    [ "name" => $name , "tmp_name" => $tmp_dir ] = $file;

    if(!file_exists($user_dir) && !is_dir($user_dir)) {
        mkdir($user_dir, 0777, true);
    }

    move_uploaded_file($tmp_dir, "$user_dir/$name");
}

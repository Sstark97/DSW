<?php
require_once "./agenda/general_functions.php";

// Contante con los tipos de ficheros válidos
define("file_types", ["application/pdf", "application/vnd.oasis.opendocument.text"]);

// Formulario de Subida de Ficheros
function uploadForm(string $action) {

    $dni = $_POST["contact_dni"];

    return <<< END
    <h1 class="text-center mt-2">Bloquear Contacto</h1>
    <form class="d-flex justify-content-end w-50 mx-auto mt-4" action="$action" method="post" enctype="multipart/form-data">
        <input type="hidden" name="MAX_FILE_SIZE" value="1000000">
        <input class="form-control" type="file" name="file_dni">
        <input type="hidden" name="contact_dni" value='$dni'>
        <button name="upload_action" class="btn btn-primary ms-1">Subir</button>
    </form>
    END;
}

// Función que realiza las comprobaciones sobre el fichero
function comprobeFile(array $file) {
    ["error" => $error, "type" => $type] = $file;
    $message = "";

    if($error === 2) {
        $message .= "<span>El tamaño máximo de subida es 1000 MB</span>";
    } else if(!in_array($type, file_types)){
        $message .= "<span>La agenta solo soporta ficheros en formato odt y pdf</span>";
    } 

    return $message;
}

// Función que sube el fichero
function uploadFile(array &$contacts) {
    $dni = $_POST["contact_dni"];
    $file = $_FILES["file_dni"];
    
    $message = comprobeFile($file);

    // Si hay mensaje de error lo devolvemos
    if(!empty($message)) {
        return createErrors($message);
    }

    [ "name" => $name , "tmp_name" => $tmp_dir ] = $file;
    $user_dir = "./agenda/files/$dni";
    $file_path = "$user_dir/$name";

    if(!file_exists($user_dir) && !is_dir($user_dir)) {
        mkdir($user_dir, 0777, true);
    }

    move_uploaded_file($tmp_dir, $file_path);
    array_push($contacts[$dni]["files"], $file_path);
    
    $_SESSION["contacts"] = $contacts;
}

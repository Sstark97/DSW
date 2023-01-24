<?php
define("file_types", ["image/png", "image/jpeg"]);

/**
 * Función que renderiza el enlace  a la página
 * donde ver todos los juegos
 */
function renderNav (string $path = "") {
    $is_admin = $_SESSION["is_admin"] ?? 0;
    $browse = !$is_admin ? "<li><a href='" . $path . "browse.php'>Browse</a></li>" : "";
    $index = "$path" . "index.php";

    return <<< END
        <li><a href="$index" class="active">Home</a></li>
        $browse
    END;
}

/**
 * Función que te redirige a inicio en
 * caso de que el id del usuario se
 * encuentre en la sesión
 */
function isLogged () {
    if (isset($_SESSION["userId"])) {
        header("Location: ../index.php");
    }
}

/**
 * Función que destruye la sesión y te redirje
 * al login
 */
function logout () {
    session_destroy();

    redirect("./pages/login.php");
}

/**
 * Redirecciona al login a usuarios sin logear
 * 
 * Función que te redirige al login en
 * caso de que el id del usuario se
 * no encuentre en la sesión
 */
function isNotLogged () {
    if (!isset($_SESSION["userId"])) {
        header("Location: ./pages/login.php");
    }
}

function redirect(string $location) {
    header("Location: $location");
    exit();
}

// Función que crea los errores a mostrar
function createErrors(string $message, bool $empty = false)
{
    $message = $empty ? "<span>$message</span>" : $message;

    return <<< END
        <div id="errors" class="d-flex flex-column align-items-center w-50 mx-auto fw-3 pt-3 text-white">
            <p class='m-0 mb-2'>Hay Errores 🐛</p>
            $message
        </div>
    END;
}

// Función que valida si hay campos de más o de menos
function comprobeFields(array $to_comprobe, array $keys)
{
    /*
    Comprobamos si hay diferencias en lo que
    nos llega con lo que debería llegar
     */
    $diff = count(array_diff(array_keys($to_comprobe), $keys));
    if ($diff !== 0) {
        return true;
    }

    // Comprobamos si hay valores vacíos
    $size_keys = count($keys);
    $stop = false;

    for ($i = 0; $i < $size_keys; $i++) {
        $key = $keys[$i];

        if (empty($to_comprobe[$key])) {
            $stop = true;
            break;
        }
    }

    return $stop;
}

// Función donde se realizan las validaciones de los datos si no están vacíos
function validateUserForm (bool $comprobePass = true) {
    $message = "";
    [
        "dni" => $dni,
        "email" => $email,
        "phone" => $phone,
        "age" => $age,
        "password" => $password
    ] = $_POST["user"];

    if(!preg_match("/\d{8}[A-Z]{1}/", $dni) || strlen($dni) !== 9) {
        $message .= "<p class='m-0 mb-2'>El dni no cumple con el formato 12345678[A-Z] (8 números y 1 letra)</p>";
    }
    
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message .= "<p class='m-0 mb-2'>El correo no cumple el formato, Ej: correo@correo.com</p>";
    }

    if(!preg_match("/\d{9}/",$phone) || strlen($phone) !== 9) {
        $message .= "<p class='m-0 mb-2'>El Telefono no tiene 9 dígitos</p>";
    }

    if(!filter_var($age, FILTER_VALIDATE_INT)) {
        $message .= "<p class='m-0 mb-2'>La edad no es un entero</p>";
    }

    if($comprobePass && !preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/",$password)) {
        $message .= "<p class='m-0 mb-2'>La contraseña debe tener minimo 8 carácteres, al menos 1 mayúscula, 1 minúscula y 1 número</p>";
    }
    
    return $message;
}

// Función que sanea los datos que nos llegan
function sanitizeFields(array $fields)
{
    $sanitize_fields = [];

    foreach ($fields as $key => $field) {
        $sanitize_field = $key !== "email" ? trim(strip_tags($field)) : trim(strip_tags(filter_var($field, FILTER_SANITIZE_EMAIL)));

        array_push($sanitize_fields, $sanitize_field);
    }

    return $sanitize_fields;
}

// Función que realiza las comprobaciones sobre el fichero
function comprobeFile(array $file, bool $is_edit = false) {
    ["error" => $error, "type" => $type] = $file;
    $message = "";
    $comprobe_files = $is_edit ? [...file_types, ""] : file_types;

    if(!in_array($type, $comprobe_files)){
        $message .= "<span>Solo se aceptan ficheros en formato jpg y png</span>";
    } 

    return $message;
}

/**
 * Función que borra una imagen previa si la imagen
 * pasada como segundo parámetro es distinta de la 
 * pasada como primer parámetro
 */
function removePreviousImg (string $previous_img, string $img_dir) {
    /**
     * Le concateno ../ ya que vamos a acceder
     * a la carpeta assets, donde se guardan todas
     * las imágenes
     */
    $previous_img_format = "../$previous_img";

    if ($previous_img_format !== $img_dir && file_exists($previous_img_format)) {
        unlink($previous_img_format);
    }
}

// Función que sube el fichero
function uploadFile(string $previous_img = "", bool $is_edit = false) {
    $file = $_FILES["img"];
    
    $message = comprobeFile($file, $is_edit);

    // Si hay mensaje de error lo devolvemos
    if(!empty($message)) {
        throw new PDOException($message);
    }

    [ "name" => $name , "tmp_name" => $tmp_dir ] = $file;


    if(empty($name) && !empty($previous_img) && $is_edit) {
        return $previous_img;
    }

    $img_dir = "../assets/images/$name";

    if(!empty($previous_img) ) {
        removePreviousImg($previous_img, $img_dir);
    }

    move_uploaded_file($tmp_dir, $img_dir);

    return $img_dir;
}

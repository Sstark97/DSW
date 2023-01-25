<?php
define("file_types", ["image/png", "image/jpeg"]);

/**
 * Renderiza los elementos del Navegador
 * 
 * Función que renderiza el enlace  a la página
 * donde ver todos los juegos
 * 
 * @param string $path representa el nivel dentro del
 * árbol de directorios
 * @return string Elementos del Navegador
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
 * Comprueba si el usuario está logeado
 * 
 * Función que te redirige a inicio en
 * caso de que el id del usuario se
 * encuentre en la sesión
 * 
 * @return void
 */
function isLogged () {
    if (isset($_SESSION["userId"])) {
        header("Location: ../index.php");
    }
}

/**
 * Cerrar sesión
 * 
 * Función que destruye la sesión y te redirje
 * al login
 * 
 *@return void
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
 * 
 * @return void
 */
function isNotLogged () {
    if (!isset($_SESSION["userId"])) {
        header("Location: ./pages/login.php");
    }
}

/**
 * Redirije a otra ruta
 * 
 * Función que redirige a la ruta pasada
 * por parámetro y se asegura de que no se 
 * ejecute nada más
 * 
 * @param string $location ruta a la que queremos dirigir
 * @return never
 */
function redirect(string $location) {
    header("Location: $location");
    exit();
}

/**
 * Fragmento HTML con los posibles errores
 * 
 * Función que genera un fragmento de código HTML
 * que muestro los errores que le pasemops como 
 * parámetro
 * 
 * @param string $message mensaje de error que queremos mostrar
 * @param bool $empty controla si debebemos envolver el mensaje en un <span></span>
 * @return string fragmento HTML con los errores
 */
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

/**
 * Comprueba los campos de un formulario
 * 
 * Función que comprueba si los elementos pasados
 * tienen las mismas claves y si existen elementos vacíos
 * en el array a comprobar
 * 
 * @param array $to_comprobe campos a comprobar
 * @param array $keys claves que queremos analizar
 * @return bool true si hay diferencias y false en caso contrario
 */
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

/**
 * Valida dni y contraseña
 * 
 * Función que valida si el dni cumple con el formato
 * 8 dígitos y una letra mayuscúla y si la contraseña
 * incluye mínimo una letra mayuscúla, un número y 8 carácteres
 * 
 * @global $_POST
 * @return string mensaje con todos los posibles errores
 */
function validateDniAndPass () {
    $message = "";
    [
        "dni" => $dni,
        "password" => $password
    ] = $_POST["user"];

    if(!preg_match("/\d{8}[A-Z]{1}/", $dni) || strlen($dni) !== 9) {
        $message .= "<p class='m-0 mb-2'>El dni no cumple con el formato 12345678[A-Z] (8 números y 1 letra)</p>";
    }

    if(!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/",$password)) {
        $message .= "<p class='m-0 mb-2'>La contraseña debe tener minimo 8 carácteres, al menos 1 mayúscula, 1 minúscula y 1 número</p>";
    }

    return $message;
}

/**
 * Valida los campos del formulario de Usuarios
 * 
 * Función que valida todos los campos sensibles del usuario,
 * como son el dni, correo, teléfono, edad y contraseña
 * 
 * @param bool $is_update nos indica si estamos actualizando el usuario
 * para saber si debemos validar dni y contraseña
 * @global $_POST
 * @return string mensaje con todos los posibles errores
 */
function validateUserForm (bool $is_update = false) {
    $message = "";
    [
        "email" => $email,
        "phone" => $phone,
        "age" => $age,
    ] = $_POST["user"];

    if(!$is_update) {
        $message .= validateDniAndPass();
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
    
    return $message;
}

/**
 * Sanitizado de los datos
 * 
 * Función que sanitiza los datos que le pasemos,
 * evitando espacios y código HTML insertado
 * 
 * @param array $fields campos a sanitizar
 * @return array campos sanitizados
 */
function sanitizeFields(array $fields)
{
    $sanitize_fields = [];

    foreach ($fields as $key => $field) {
        $sanitize_field = $key !== "email" ? trim(strip_tags($field)) : trim(strip_tags(filter_var($field, FILTER_SANITIZE_EMAIL)));

        array_push($sanitize_fields, $sanitize_field);
    }

    return $sanitize_fields;
}

/**
 * Validación de la subida de una imagen
 * 
 * Función que comprueba los posibles errores a 
 * la hora de subir una imagen
 * 
 * @param array $img imagen a subir
 * @param bool $is_edit si estamos editando un fichero ya subido
 * @return string mensaje con los posibles errores
 */
function comprobeImgFIle(array $img, bool $is_edit = false) {
    ["error" => $error, "type" => $type] = $img;
    $message = "";
    $comprobe_files = $is_edit ? [...file_types, ""] : file_types;

    if(!in_array($type, $comprobe_files)){
        $message .= "<span>Solo se aceptan ficheros en formato jpg y png</span>";
    } else if (!empty($error)) {
        $message .= "<span>$error</span>";
    }

    return $message;
}

/**
 * Borra la imagen anterior 
 * 
 * Función que borra una imagen previa si la imagen
 * pasada como segundo parámetro es distinta de la 
 * pasada como primer parámetro
 * 
 * @param string ruta a la imagen previa
 * @param string directorio actual a comparar
 * @return void
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

/**
 * Subida de una imagen
 * 
 * Funcioón que se encarga de subir una imagen, comprobando antes
 * los posibles errores a la hora de subir una imagen
 * 
 * @param string $previous_img ruta a la imagen previa
 * @param bool $is_edit si estamos subiendo una nueva imagen
 * @global $_FILES
 * @throws PDOException excepción generada si hay fallos a la hora de subir la imagen
 * @return string ruta de la imagen subida
 */
function uploadImg(string $previous_img = "", bool $is_edit = false) {
    $file = $_FILES["img"];
    
    $message = comprobeImgFIle($file, $is_edit);

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

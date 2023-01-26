<?php
require_once "general.php";
require_once "../config/config.php";

// Claves a comprobar en el Login
define("keys", ["email", "password"]);

/**
 * Validación de campos del Login
 * 
 * Función donde se realizan las validaciones de 
 * los datos si no están vacíos
 * 
 * @global $_POST
 * @return string posibles mensaje de error
 */
function validateLoginForm () {
    $message = "";
    [
        "email" => $email,
    ] = $_POST["user"];
    
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message .= "<p class='m-0 mb-2'>El correo no cumple el formato, Ej: correo@correo.com</p>";
    }
    
    return $message;
}

/**
 * Login del usuario en la BD
 * 
 * Función que extrae el dni, la contraseña
 * y si el usuario es administrador, para guardar en 
 * la sesión dicho dni y su condición de admin
 * 
 * @global $_SESSION
 * @throws PDOException
 * @return mixed
 */
function loginUser () {

    try {
        $connection = getDbConnection();

        [
            $sanitize_email, 
            $sanitize_password
        ] = sanitizeFields($_POST["user"]);

        $sql_query = "SELECT dni, password, is_admin FROM User WHERE email = :email";

        $sentence = $connection->prepare($sql_query);
        $sentence->bindValue(":email", $sanitize_email, PDO::PARAM_STR);

        $sentence->execute();
        ["dni" => $dni, "password" => $password, "is_admin" => $admin] = $sentence->fetch();

        /**
         * Si el DNI no existe lanzamos una
         * excepción
         */
        if(empty($dni)) {
            throw new PDOException("El usuario no existe");  
        }

        if($admin) {
            if ($password !== $sanitize_password) {
                throw new PDOException("La contraseña no es correcta");
            }
        } else {
            if (!password_verify($sanitize_password, $password)) {
                throw new PDOException("La contraseña no es correcta");
            }
        }

        $_SESSION["userId"] = $dni;
        $_SESSION["is_admin"] = $admin;

        redirect("../index.php");
    } catch (PDOException $error) {
        return createErrors($error->getMessage());
    }
}

/**
 * Gestión de las acciones del Login
 * 
 * Función que comprueba los errores y realiza la acción de registro
 * 
 * @return string posibles errores
 */
function loginAction () {
    $is_ok = comprobeFields($_POST["user"], keys);
    $message = $is_ok ? createErrors("Existen campos vacíos o campos de más", true) : validateLoginForm();

    if(empty($message) && !$is_ok ) {
        $message = loginUser();
    } else if(!empty($message) && !$is_ok) {
        $message = createErrors($message);
    }

    return $message;
}

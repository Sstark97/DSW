<?php
require_once "general.php";
require_once "../config/config.php";

session_name("videogames");
session_start();

define("keys", ["email", "password"]);

// Función donde se realizan las validaciones de los datos si no están vacíos
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

function loginUser () {

    try {
        $connection = getDbConnection();

        [
            $sanitize_email, 
            $sanitize_password
        ] = sanitizeFields($_POST["user"]);

        $sql_query = "SELECT dni, password FROM USER WHERE email = :email";

        $sentence = $connection->prepare($sql_query);
        $sentence->bindValue(":email", $sanitize_email, PDO::PARAM_STR);

        $sentence->execute();
        ["dni" => $dni, "password" => $password] = $sentence->fetch();

        if(empty($dni)) {
            throw new PDOException("El usuario no existe");  
        } else if(!password_verify($sanitize_password, $password)) {
            throw new PDOException("La contraseña no es correcta");
        }

        $_SESSION["userId"] = $dni;
        header("Location: ../index.php");
        exit();
    } catch (PDOException $error) {
        return createErrors($error->getMessage());
    }
}

// Función que comprueba los errores y realiza la acción de registro
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

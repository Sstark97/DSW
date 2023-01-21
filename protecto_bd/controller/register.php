<?php
require_once "general.php";
require_once "../config/config.php";

session_name("videogames");
session_start();

define("keys", ["dni","name","surname", "email", "phone", "age", "password"]);
define("salt", "my_secret_hash_password");

// Función donde se realizan las validaciones de los datos si no están vacíos
function validateRegisterForm () {
    $message = "";
    [
        "dni" => $dni, 
        "name" => $name,
        "surname" => $surname, 
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

    if(!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/",$password)) {
        $message .= "<p class='m-0 mb-2'>La contraseña debe tener minimo 8 carácteres, al menos 1 mayúscula, 1 minúscula y 1 número</p>";
    }
    
    return $message;
}

function userExist(string $dni) {
    try {
        $connection = getDbConnection();

        $sql_query = "SELECT email FROM USER WHERE dni = :dni";

        $sentence = $connection->prepare($sql_query);
        $sentence->bindValue(":dni", $dni, PDO::PARAM_STR);

        $sentence->execute();
        ["email" => $email ] = $sentence->fetch();

        return !empty($email);
    } catch (PDOException $error) {
        
        return createErrors($error->getMessage());
    }
}

// Función en la que se crea el usurio el Usuario
function createUser() {

    try {
        $connection = getDbConnection();

        [
            $sanitize_dni, 
            $sanitize_name, 
            $sanitize_surname, 
            $sanitize_email, 
            $sanitize_phone, 
            $sanitize_age, 
            $sanitize_password
        ] = sanitizeFields($_POST["user"]);

        if(userExist($sanitize_dni)) {
            throw new PDOException("El usuario ya existe");
        }

        $hash_password = password_hash($sanitize_password, PASSWORD_BCRYPT, ["salt" => salt, "cost" => 12]);

        $user = [
            "dni" => $sanitize_dni,
            "name" => $sanitize_name,
            "surname" => $sanitize_surname,
            "email" => $sanitize_email,
            "phone" => $sanitize_phone,
            "age" => intval($sanitize_age),
            "password" => $hash_password
        ];

        $sql_query = <<< END
            INSERT INTO User (dni, name, surname, email, phone, age, password) VALUES 
            (:dni, :name, :surname, :email, :phone, :age, :password)
        END;

        $sentence = $connection->prepare($sql_query);

        foreach($user as $key => $field) {
            $type = $key === "age" ? PDO::PARAM_INT : PDO::PARAM_STR;

            $sentence->bindValue(":$key", $field, $type);
        }

        $sentence->execute();

        $_SESSION["userId"] = $sanitize_dni;
        header("Location: ../index.php");
        exit();
    } catch (PDOException $error) {
        
        return createErrors($error->getMessage());
    }
}

// Función que comprueba los errores y realiza la acción de registro
function registerAction () {
    $is_ok = comprobeFields($_POST["user"], keys);
    $message = $is_ok ? createErrors("Existen campos vacíos o campos de más", true) : validateRegisterForm();

    if(empty($message) && !$is_ok ) {
        $message = createUser();
    } else if(!empty($message) && !$is_ok) {
        $message = createErrors($message);
    }

    return $message;
}

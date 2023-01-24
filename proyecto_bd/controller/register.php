<?php
require_once "general.php";
require_once "../config/config.php";

define("keys", ["dni","name","surname", "email", "phone", "age", "password"]);
define("salt", "my_secret_hash_password");

function userExist(string $dni) {
    try {
        $connection = getDbConnection();

        $sql_query = "SELECT email FROM User WHERE dni = :dni";

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
        
        redirect("../index.php");
    } catch (PDOException $error) {
        
        return createErrors($error->getMessage());
    }
}

// Función que comprueba los errores y realiza la acción de registro
function registerAction () {
    $is_ok = comprobeFields($_POST["user"], keys);
    $message = $is_ok ? createErrors("Existen campos vacíos o campos de más", true) : validateUserForm();

    if(empty($message) && !$is_ok ) {
        $message = createUser();
    } else if(!empty($message) && !$is_ok) {
        $message = createErrors($message);
    }

    return $message;
}

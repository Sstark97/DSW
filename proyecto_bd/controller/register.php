<?php
require_once "general.php";
require_once "../config/config.php";

define("keys", ["dni","name","surname", "email", "phone", "age", "password"]);
define("salt", "my_secret_hash_password");

/**
 * Comprueba si un usuario existe
 * 
 * Función que comprueba si un usuario existe en 
 * la BD
 *  
 * @param string $dni del usuario
 * @return bool|string
 */
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

/**
 * Crea un usuario en la BD
 * 
 * Función que crea un usuario en 
 * la BD, comprobando si el usuario existe
 *  
 * @global $_POST
 * @throws PDOException si el usuario existe
 * @param string $dni del usuario
 * @return mixed 
 */
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

/**
 * Gestión de Registro del usuario
 * 
 * Función que comprueba los errores y realiza la acción de registro
 * 
 * @global $_POST
 * @return mixed
 */
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

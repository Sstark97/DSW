<?php

namespace Controller;

use PDO;
use PDOException;

class RegisterController {
    private const SALT =  "my_secret_hash_password";
    const REGISTER_KEYS = ["dni","name","surname", "email", "phone", "age", "password"];

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
    public static function register() {

        try {
            $connection = ConfigController::getDbConnection();

            [
                $sanitize_dni, 
                $sanitize_name, 
                $sanitize_surname, 
                $sanitize_email, 
                $sanitize_phone, 
                $sanitize_age, 
                $sanitize_password
            ] = GeneralController::sanitizeFields($_POST["user"]);

            if(UserController::userExist($sanitize_dni)) {
                throw new PDOException("El usuario ya existe");
            }

            $hash_password = password_hash($sanitize_password, PASSWORD_BCRYPT, ["salt" => self::SALT, "cost" => 12]);

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
            
            AuthController::redirect("../index.php");
        } catch (PDOException $error) {
            
            return GeneralController::createErrors($error->getMessage());
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
    public static function registerAction () {
        $is_ok = GeneralController::comprobeFields($_POST["user"], self::REGISTER_KEYS);
        $message = $is_ok 
            ? GeneralController::createErrors("Existen campos vacíos o campos de más", true) 
            : UserController::validateUserForm();

        if(empty($message) && !$is_ok ) {
            $message = self::register();
        } else if(!empty($message) && !$is_ok) {
            $message = GeneralController::createErrors($message);
        }

        return $message;
    }
}
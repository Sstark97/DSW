<?php

namespace Controller;

use PDO;
use PDOException;

class LoginController {
    // Claves a comprobar en el Login
    const LOGIN_KEYS = ["email", "password"];

    /**
     * Validación de campos del Login
     * 
     * Función donde se realizan las validaciones de 
     * los datos si no están vacíos
     * 
     * @global $_POST
     * @return string posibles mensaje de error
     */
    private static function validateLoginForm () {
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
    private static function login () {

        try {
            $connection = ConfigController::getDbConnection();

            [
                $sanitize_email, 
                $sanitize_password
            ] = GeneralController::sanitizeFields($_POST["user"]);

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

            AuthController::redirect("../index.php");
        } catch (PDOException $error) {
            return GeneralController::createErrors($error->getMessage());
        }
    }

    /**
     * Gestión de las acciones del Login
     * 
     * Función que comprueba los errores y realiza la acción de registro
     * 
     * @return string posibles errores
     */
    public static function loginAction () {
        $is_ok = GeneralController::comprobeFields($_POST["user"], self::LOGIN_KEYS);
        $message = $is_ok 
            ? GeneralController::createErrors("Existen campos vacíos o campos de más", true) 
            : self::validateLoginForm();

        if(empty($message) && !$is_ok ) {
            $message = self::login ();
        } else if(!empty($message) && !$is_ok) {
            $message = GeneralController::createErrors($message);
        }

        return $message;
    }
}
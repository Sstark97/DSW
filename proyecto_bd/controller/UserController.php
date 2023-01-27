<?php

namespace Controller;

use PDO;
use PDOException;

class UserController {
    const GRAVATAR_URI = "https://www.gravatar.com/avatar/";

    /** Contenido del Formulario de Eliminar Cuenta */
    const DELETE_CONTENT = "<h4>¿Estás seguro de borrar tu cuenta?</h2><p>Está acción será irreversible</p>";

    /** Claves a revisar del Formulario de Actualización del Perfil */
    const PROFILE_KEYS =  ["name","surname", "email", "phone", "age"];
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
    private static function validateDniAndPass () {
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
     * @global $_POST
     * @param bool $is_update nos indica si estamos actualizando el usuario
     * para saber si debemos validar dni y contraseña
     * @return string mensaje con todos los posibles errores
     */
    public static function validateUserForm (bool $is_update = false) {
        $message = "";
        [
            "email" => $email,
            "phone" => $phone,
            "age" => $age,
        ] = $_POST["user"];

        if(!$is_update) {
            $message .= self::validateDniAndPass();
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
     * Comprueba si un usuario existe
     * 
     * Función que comprueba si un usuario existe en 
     * la BD
     *  
     * @param string $dni del usuario
     * @return bool|string
     */
    public static function exist (string $dni) {
        try {
            $connection = ConfigController::getDbConnection();

            $sql_query = "SELECT email FROM User WHERE dni = :dni";

            $sentence = $connection->prepare($sql_query);
            $sentence->bindValue(":dni", $dni, PDO::PARAM_STR);

            $sentence->execute();
            ["email" => $email ] = $sentence->fetch();

            return !empty($email);
        } catch (PDOException $error) {
            
            return GeneralController::createErrors($error->getMessage());
        }
    }

    /**
     * Genera un enlace de Gravatar
     * 
     * Función que genera un enlace de Gravatar, concatenando el
     * hash del $email con el enlace de gravatar
     * @link https://es.gravatar.com/ Enlace de Gravatar
     * 
     * @param string $email con el que se generará el hash
     * @return string enlace de Gravatar
     */
    private static function generateUserProfileImg (string $email) {
        $hash = md5( strtolower( trim( $email ) ) );

        return self::GRAVATAR_URI . $hash;
    }

    /**
     * Devuelve los datos del usuario en sesión
     * 
     * Función que devuelve los datos del usuario que
     * se encuentra en sesión.
     * 
     * @global $_SESSION
     * @return mixed array con los datos del usuario | 
     * error si fallará la consulta
     */
    public static function get () {
        $user_id = $_SESSION["userId"] ?? "";

        if(!empty($user_id)) {
            try {
                $connection = ConfigController::getDbConnection();

                $sql_query = "SELECT * FROM User WHERE dni = :dni";
        
                $sentence = $connection->prepare($sql_query);
                $sentence->bindValue(":dni", $user_id, PDO::PARAM_STR);
        
                $sentence->execute();

                $user_data = $sentence->fetch(PDO::FETCH_ASSOC);

                return $user_data;

            } catch (PDOException $error) {
                return GeneralController::createErrors($error->getMessage());
            }
        }
    }

    /**
     * Actualización de un Usuario
     * 
     * Función que actualiza el nombre, apellidos
     * email, teléfono, y edad de un usuario en la
     * BD
     * 
     * @global $_SESSION
     * @return mixed
     */
    private static function update () {
        $user_id = $_SESSION["userId"] ?? "";

        if(!empty($user_id)) {
            try {
                $connection = ConfigController::getDbConnection();

                [
                    $sanitize_name, 
                    $sanitize_surname, 
                    $sanitize_email, 
                    $sanitize_phone, 
                    $sanitize_age,
                ] = GeneralController::sanitizeFields($_POST["user"]);

                $user = [
                    "name" => $sanitize_name,
                    "surname" => $sanitize_surname,
                    "email" => $sanitize_email,
                    "phone" => $sanitize_phone,
                    "age" => intval($sanitize_age)
                ];

                $sql_query = <<< END
                    UPDATE User SET name = :name,
                    surname = :surname, email = :email,
                    phone = :phone, age = :age 
                    WHERE dni = :dni
                END;
        
                $sentence = $connection->prepare($sql_query);

                foreach($user as $key => $field) {
                    $type = $key === "age" ? PDO::PARAM_INT : PDO::PARAM_STR;
        
                    $sentence->bindValue(":$key", $field, $type);
                }

                $sentence->bindValue(":dni", $user_id, PDO::PARAM_STR);
                $sentence->execute();

                GeneralController::redirect("../pages/profile.php");

            } catch (PDOException $error) {
                return GeneralController::createErrors($error->getMessage());
            }
        }
    }

    /**
     * Borra la cuenta de un usuario
     * 
     * Función que borra la cuenta del usuario en sesión
     * 
     * @global $_SESSION
     * @return mixed
     */
    private static function delete () {
        $user_id = $_SESSION["userId"] ?? "";

        if(!empty($user_id)) {
            try {
                $connection = ConfigController::getDbConnection();

                $sql_query = "DELETE FROM User WHERE dni = :dni";
        
                $sentence = $connection->prepare($sql_query);
                $sentence->bindValue(":dni", $user_id, PDO::PARAM_STR);
        
                $sentence->execute();

                session_destroy();
                GeneralController::redirect("../index.php");

            } catch (PDOException $error) {
                return GeneralController::createErrors($error->getMessage());
            }
        }
    }

    /**
     * Gestión de la actualización de datos de Usuario
     * 
     * Función que realiza las comprobaciones sobre los datos
     * recibidos en el formulario y realiza la acción de actualizar los
     * datos si todo va bien
     * 
     * @global $_POST
     * @return mixed
     */
    private static function updateAction () {
        $fail = GeneralController::comprobeFields($_POST["user"], self::PROFILE_KEYS);
        $message = $fail 
            ? GeneralController::createErrors("Existen campos vacíos o campos de más", true) 
            : self::validateUserForm(true);

        if(empty($message) && !$fail ) {
            $message = self::update();
        } else if(!empty($message) && !$fail) {
            $message = GeneralController::createErrors($message);
        }

        return $message;
    }

    /**
     * Gestión sobre las acciones del Perfil
     * 
     * Función que gestiona las acciones sobre el perfil
     * de un usuario
     * 
     * @global $_POST
     * @return mixed
     */
    public static function profileAction () {
        if(isset($_POST["deleteUser"])) {
            self::delete();
        } else if (isset($_POST["updateUser"])) {
            return self::updateAction();
        }
    }

    /**
     * Formulario para actualizar los datos de un usuario
     * 
     * Función que devuelve el código HTML de un formulario 
     * de actualización de los datos de un usuario.
     * 
     * @return string formulario con los datos del usuario | mensaje de error
     */
    public static function updateForm () {
        $user = self::get();
        $content = "";

        if(is_array($user)) {
            [
                "name" => $name,
                "surname" => $surname,
                "email" => $email,
                "phone" => $phone,
                "age" => $age,
            ] = $user;

            $content .= <<<END
            <div class="form-outline form-white mb-1">
                <div class="form-outline form-white mb-1">
                    <label class="form-label" for="user[name]">Nombre</label>
                    <input type="text" name="user[name]" value="$name" class="form-control" />
                </div>
                <div class="form-outline form-white mb-1">
                    <label class="form-label" for="user[surname]">Apellidos</label>
                    <input type="text" name="user[surname]" value="$surname" class="form-control" />
                </div>

                <div class="form-outline form-white mb-1">
                    <label class="form-label" for="user[email]">Email</label>
                    <input type="email" name="user[email]" id="typeEmailX" value="$email" class="form-control" required/>
                </div>

                <div class="form-outline form-white mb-1">
                    <label class="form-label" for="user[phone]">Teléfono</label>
                    <input type="text" name="user[phone]" value="$phone" class="form-control" required/>
                </div>

                <div class="form-outline form-white mb-1">
                    <label class="form-label" for="user[age]">Edad</label>
                    <input type="text" name="user[age]" value="$age" class="form-control" />
                </div>
            </div>
            END;
        } else {
            $content = "<p>El usuario no existe</p>";
        }

        return $content;
    }

    /**
     * Modal HTML que maneja las acciones sobre un perfil
     * 
     * Función que genera el bloque HTML de un Modal, con el que 
     * manejar las acciones de edición/eliminación de un usuario
     * dependiendo de el parámetro $is_delete 
     * 
     * @param string $label etiqueta del modal
     * @param string $modal_id id que identifica el modal
     * @param bool $is_delete determina la acción a realizar
     * @return string Bloque HTML del Modal
     */
    private static function profileModal (string $label, string $modal_id, bool $is_delete = false) {
        $modal_label = $modal_id . "Label";
        $btn_class = $is_delete ? "btn-danger" : "btn-warning";
        $btn_name = $is_delete ? "deleteUser" : "updateUser";
        $content = $is_delete ? self::DELETE_CONTENT : self::updateForm();

        return <<<END
            <div class="main-border-button">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#$modal_id">
                    $label
                </button>
            </div>

            <div class="modal fade" id="$modal_id" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="$modal_label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content bg-dark">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="$modal_label">$label</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-dark">
                    $content
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" name="$btn_name" class="btn $btn_class">Envíar</button>
                </div>
                </div>
            </div>
            </div>
        END;
    }

    /**
     * Genera un fragmento de HTML con la información del perfil
     * 
     * Función que genera un fragmento de código HTML con la información
     * del usuario que se encuente en sesión
     * 
     * @param int $whislist_count Número de elementos en la lista de deseados
     * @return string Contenido HTML con la información del Perfil
     */
    public static function profileCard (int $whislist_count) {
        $user_data = self::get();

        if(count($user_data) === 0) {
            return "<h1 class='text-center'>No hay datos de usuario</h1>";
        }

        [   
            "name" => $name,
            "surname" => $surname,
            "age" => $age,
            "email" => $email,
            "phone" => $phone
        ] = $user_data;
        $gravatar_img = self::generateUserProfileImg($email);
        $update_modal = self::profileModal("Editar Perfil", "updateUser");
        $delete_modal = self::profileModal("Borrar Perfil", "deleteUser", true);
        $action = $_SERVER["PHP_SELF"];

        return <<< END
        <div class="col-lg-4">
            <img src="$gravatar_img" alt="$name" style="border-radius: 23px;">
        </div>
        <div class="col-lg-4 align-self-center">
            <div class="main-info header-text">
                <h4>$name</h4>
                <p>$surname</p>
                <form method="post" action="$action">
                    $update_modal
                    $delete_modal
                </form>
            </div>
        </div>
        <div class="col-lg-4 align-self-center">
            <ul>
                <li>Lista de Deseados<span>$whislist_count</span></li>
                <li>Correo <span>$email</span></li>
                <li>Edad <span>$age</span></li>
                <li>Teléfono<span>$phone</span></li>
            </ul>
        </div>
        END;
    }

}
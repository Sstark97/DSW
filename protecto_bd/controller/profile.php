<?php

require_once "general.php";

define("gravatar_uri", "https://www.gravatar.com/avatar/");

/**
 * Genera un enlace de Gravatar
 * 
 * Función que genera un enlace de Gravatar, concatenando el
 * hash del $email con el enlace de gravatar
 * @link https://www.gravatar.com/avatar/ Enlace de Gravatar
 * 
 * @param string $email con el que se generará el hash
 * @return string enlace de Gravatar
 */
function generateUserProfileImg (string $email) {
    $hash = md5( strtolower( trim( $email ) ) );

    return gravatar_uri . $hash;
}

/**
 * Devuelve los datos del usuario en sesión
 * 
 * Función que devuelve los datos del usuario que
 * se encuentra en sesión.
 * 
 * @return mixed array con los datos del usuario | 
 * error si fallará la consulta
 */
function getUserData () {
    $user_id = $_SESSION["userId"] ?? "";

    if(!empty($user_id)) {
        try {
            $connection = getDbConnection();

            $sql_query = "SELECT * FROM User WHERE dni = :dni";
    
            $sentence = $connection->prepare($sql_query);
            $sentence->bindValue(":dni", $user_id, PDO::PARAM_STR);
    
            $sentence->execute();

            $user_data = $sentence->fetch(PDO::FETCH_ASSOC);

            return $user_data;

        } catch (PDOException $error) {
            return createErrors($error->getMessage());
        }
    }
}

/**
 * Borra la cuenta de un usuario
 * 
 * Función que borra la cuenta del usuario en sesión
 * 
 * @return mixed
 */
function deleteUser () {
    $user_id = $_SESSION["userId"] ?? "";

    if(!empty($user_id)) {
        try {
            $connection = getDbConnection();

            $sql_query = "DELETE FROM User WHERE dni = :dni";
    
            $sentence = $connection->prepare($sql_query);
            $sentence->bindValue(":dni", $user_id, PDO::PARAM_STR);
    
            $sentence->execute();

            session_destroy();
            redirect("../index.php");

        } catch (PDOException $error) {
            return createErrors($error->getMessage());
        }
    }
}

function profileModal (string $label, string $modal_id, bool $is_delete = false) {
    $modal_label = $modal_id . "Label";
    $btn_class = $is_delete ? "btn-danger" : "btn-warning";
    $btn_name = $is_delete ? "deleteUser" : "updateUser";

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
                <h4>¿Estás seguro de borrar tu cuenta?</h2>
                <p>Está acción será irreversible</p>
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
function profileCard (int $whislist_count) {
    $user_data = getUserData();

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
    $gravatar_img = generateUserProfileImg($email);
    $update_modal = profileModal("Editar Perfil", "updateUser");
    $delete_modal = profileModal("Borrar Perfil", "deleteUser", true);
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

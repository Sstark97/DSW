<?php
require_once "config/functions.php";

/**
 * Función que devuelve los Usuarios de la BD Schedule
 * o devuelve un fallo en caso de haberlo
 * 
 * @return result: Resultado de ejecutar la consulta
*/
function getUsers () {
    $result = [
        "error" => "",
        "sentence" => "",
        "users" => []
    ];

    try {
        $connection = getDbConnection();

        $sql_query = "SELECT * FROM User";

        $sentence = $connection->prepare($sql_query);
        $sentence->execute();
        $users = $sentence->fetchAll(PDO::FETCH_ASSOC);

        $result["sentence"] = $sentence;
        $result["users"] = $users;
    } catch (PDOException $pdo_error) {
        $result["error"] = $pdo_error->getMessage();
    }

    return $result;
}

/**
 * Función que devuelve los usuarios de la BD schedule
 * o devuelve un fallo en caso de haberlo
 * 
 * @return result: Resultado de ejecutar la consulta
*/
function deleteUser (int $id) {
    $result = [
        "error" => "",
        "sentence" => "",
    ];

    try {
        $connection = getDbConnection();

        $sql_query = "DELETE FROM User WHERE id= :id";

        $sentence = $connection->prepare($sql_query);
        $sentence->bindParam(":id", $id, PDO::PARAM_INT);
        $sentence->execute();

        $result["sentence"] = $sentence;
    } catch (PDOException $pdo_error) {
        $result["error"] = $pdo_error->getMessage();
    }

    return $result;
}

// Creación de la tabla de contactos
function createContactsTable () {
    $response = getUsers();
    $contacts = isset($response["users"]) ? $response["users"] : [];
    $tbody = "";

    if(count($contacts) === 0) {
        return <<< END
            <form>
                <h1 class='text-center mt-2'>No hay contactos</h1>
            </form>
        END;
    }

    // Creación de la Tabla
    foreach ($contacts as $key => $contact) {
        $id = "";
        foreach ($contact as $field_key => $field) {
            $id .= $field_key === "id" ? $field : "";
            $tbody .=  $field_key !== "id" ? "<td>$field</td>" : "";
        }
        
        $tbody .= <<< END
            <td>
                <div class="text-center">
                    <button class="btn btn-danger" name="delete" onclick='deleteInJs($id)'>
                        <i class='bx bxs-trash'></i>
                    </button>
                </div>
            </td>
        END;
        $tbody .= "</tr>";
    }

    return <<< END
        <h1 class="text-center mt-3">Contactos</h1>
        <table class="table table-bordered table-dark w-75 mx-auto mt-2">
            <thead>
                <tr>
                    <td>Dni</td>
                    <td>Nombre</td>
                    <td>Apellidos</td>
                    <td>Email</td>
                    <td>Telefono</td>
                    <td>Acciones</td>
                </tr>
            </thead>
            <thbody>
                $tbody
            </thbody>
        </table>
    END;
}
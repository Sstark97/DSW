<?php
require_once "general_functions.php";

// Constante que define los campos que no deben aparecer en la tabla
define("not_fields", ["block", "files"]);

// Función que ordena los contactos
function orderContacts (array &$contacts, bool $by_key = true, string $value = "name") {
    
    if($by_key) {
        ksort($contacts);
        return;
    }

    uasort($contacts, function ($a, $b) use ($value) {
        return $a[$value] <=> $b[$value];
    });

}

// Formulario que controla el tipo de orden
function orderForm (string $action, array $contacts) {
    $json_contacts = json_encode($contacts);

    return <<< END
        <form class="d-flex justify-content-end w-75 mx-auto mt-4" action="$action" method="post">
            <select name="order" class="form-select w-25">
                <option value="dni">Dni</option>
                <option value="name">Nombre</option>
                <option value="surname">Apellidos</option>
            </select>
            <input type="hidden" name="contacts" value='$json_contacts'>
            <button name="order_action" class="btn btn-primary ms-1">Ordenar</button>
        </form>
    END;
}

// Creación de la tabla de contactos
function createContactsTable (array $contacts, string $action) {
    $tbody = "";
    $json_contacts = json_encode($contacts);

    // Filtrado de los contactos que no están bloqueados
    $contacts = array_filter($contacts, function (array $contact){
        return !$contact["block"];
    });

    // Si todos están bloqueados no muestra la tabla
    if(count($contacts) === 0) {
        return <<< END
            <form>
                <h1 class='text-center mt-2'>No hay contactos</h1>
                <input type='hidden' name='contacts' value='$json_contacts'>
            </form>
        END;
    }

    // Si le llega el resultado del Formulario ordean
    if (isset($_POST["order"])) {
        orderContacts($contacts, $_POST["order"] === "dni", $_POST["order"]);
    }

    // Creación de la Tabla
    foreach ($contacts as $key => $contact) {
        $tbody .= "<tr><td>$key</td>";
        foreach ($contact as $field_key => $field) {
            $field = $field_key === "timestamp_insert" ? formatTimeStamp($field) : $field;
            $tbody .= !in_array($field_key, not_fields)  ? "<td>$field</td>" : "";
        }
        
        $tbody .= <<< END
            <td>
                <form class="text-center" action="$action" method="post">
                    <button type="submit" class="btn btn-warning" name="action[update]">
                        <i class='bx bxs-edit'></i>
                        <input type="hidden" name="contact_dni" value=$key>
                    </button>
                    <button type="submit" class="btn btn-primary" name="action[upload]">
                        <i class='bx bxs-file-import'></i>
                        <input type="hidden" name="contact_dni" value=$key>
                    </button>
                    <input type="hidden" name="contacts" value='$json_contacts'>
                </form>
            </td>
        END;
        $tbody .= "</tr>";
    }

    // Creamos el formulario de ordenamiento
    $orderForm = orderForm($action, $contacts);

    return <<< END
        <h1 class="text-center mt-3">Contactos</h1>
        $orderForm
        <table class="table table-bordered table-dark w-75 mx-auto mt-2">
            <thead>
                <tr>
                    <td>Dni</td>
                    <td>Nombre</td>
                    <td>Apellidos</td>
                    <td>Fecha de nacimiento</td>
                    <td>Telefono</td>
                    <td>Email</td>
                    <td>Fecha de Inserción</td>
                    <td>Acciones</td>
                </tr>
            </thead>
            <thbody>
                $tbody
            </thbody>
        </table>
    END;
}
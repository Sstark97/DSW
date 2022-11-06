<?php
require_once "general_functions.php";

function createContactsTable (array $contacts) {
    $tbody = "";

    if(count($contacts) === 0) {
        return "<h1 class='text-center mt-2'>No hay contactos</h1>";
    }

    $time_format = "%A, %d de %B, %h:%m:%s %a";
    foreach ($contacts as $key => $contact) {
        $tbody .= "<tr><td>$key</td>";
        foreach (json_decode($contact, true) as $field_key => $field) {
            $field = $field_key === "timestamp_insert" ? formatTimeStamp($field) : $field;
            $tbody .= "<td>$field</td>";
        }
        $tbody .= "</tr>";
    }

    return <<< END
        <h1 class="text-center mt-2">Contactos</h1>
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
                </tr>
            </thead>
            <thbody>
                $tbody
            </thbody>
        </table>
    END;
}
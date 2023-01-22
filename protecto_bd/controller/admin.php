<?php

require_once "games.php";

// Creación de la tabla de contactos
function createAdminTable () {
    $games = getAllGames();
    $tbody = "";

    // Si todos están bloqueados no muestra la tabla
    if(count($games) === 0) {
        return <<< END
            <form>
                <h1 class='text-center mt-2'>No hay videojuegos</h1>
            </form>
        END;
    }

    // Creación de la Tabla
    foreach ($games as $game) {
        $id = "";
        foreach ($game as $key => $field) {
            $id .= $key === "id" ? $field : "";
            $tbody .= "<td>$field</td>";
        }
        
        $tbody .= <<< END
            <td>
                <div class="text-center">
                    <a href="./pages/editGame.php?id=$id" class="btn btn-warning">
                        <i class='fa fa-pencil'></i>
                    </a>
                    <a href="./pages/deleteGame.php?id=$id" class="btn btn-danger">
                        <i class='fa fa-trash'></i>
                    </a>
                </div>
            </td>
        END;
        $tbody .= "</tr>";
    }

    return <<< END
        <table class="table table-bordered table-dark w-75 mx-auto mt-2">
            <thead>
                <tr>
                    <td>Id</td>
                    <td>Nombre</td>
                    <td>Descripción</td>
                    <td>Género</td>
                    <td>Precio</td>
                    <td>Valoración</td>
                    <td>Fecha de Lanzamiento</td>
                    <td>Acciones</td>
                </tr>
            </thead>
            $tbody
        </table>
    END;
}

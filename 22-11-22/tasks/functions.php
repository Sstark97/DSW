<?php
define("fields", ["task", "submit"]);

function createTable ($action) {
    $tasks = $_SESSION["tasks"] ?? [];

    if(count($tasks) === 0) {
        return "<p class='text-center'>No hay tareas</p>";
    }

    $table = <<< END
        <table class="table table-dark table-bordered">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Tarea</th>
                    <th scope="col">Acción</th>
                </tr>
            </thead>
            <tbody>
    END;

    foreach($tasks as $id => $task) {
        ["name" => $task_name] = $task;

        $table .= <<< END
            <tr>
                <td>$id</td>
                <td>$task_name</td>
                <td>
                    <form action="$action" method="post">
                        <button name="del_task" class="btn btn-danger"><i class='bx bx-trash'></i></button>
                        <input type="hidden" name="task_id" value=$id>
                    </form>
                </td>
            </tr>
        END;
    }

    return $table;
}

function createError ($error) {
    return <<< END
    <div class="d-flex align-items-center justify-content-center w-50 mx-auto mb-1">
        <div class="alert alert-dismissible fade show alert-danger w-75" role="alert">
            <div>
                <strong>Error!: </strong>$error
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
    END;
}

function comprobeTask () {
    $error = "";

    if(count(array_diff(array_keys($_POST), fields)) !== 0) {
        $error .= createError("Hay campos de más");
    } else if(!isset($_POST["task"])) {
        $error .= createError("No se ha podido enviar la tarea");
    } else if(empty($_POST["task"])) {
        $error .= createError("Las Tareas no pueden estar vacías");
    } 

    return $error;
}

function addTask () {
    $error = comprobeTask();

    if(!empty($error)) {
        return $error;
    }

    ["task" => $task] = $_POST;

    $tasks = $_SESSION["tasks"] ?? [];

    /*
        Creo el id en base al último, por si borro un elemento
        de la mitad de la lista, no sobreescriba otro elemento
    */
    $id  = array_search(end($tasks), $tasks) + 1;

    $tasks[$id] = ["name" => $task];
    $_SESSION["tasks"] = $tasks;
}

function deleteTask () {
    ["task_id" => $id] = $_POST;
    $tasks = $_SESSION["tasks"];

    unset($tasks[$id]);

    $_SESSION["tasks"] = $tasks;
}
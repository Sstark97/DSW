<?php

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

function addTask () {
    ["task" => $task] = $_POST;
    $tasks = $_SESSION["tasks"] ?? [];
    $id  = count($tasks);

    $tasks[$id] = ["name" => $task];
    $_SESSION["tasks"] = $tasks;
}

function deleteTask () {
    ["task_id" => $id] = $_POST;
    $tasks = $_SESSION["tasks"];

    unset($tasks[$id]);

    $_SESSION["tasks"] = $tasks;
}
<?php
    require_once "./database/TaskController.php";

    $host = "localhost";
    $data_base = "test";
    $user_name = "sstark97";
    $password = "password";

    $db = new TaskController ($host, $user_name, $password, $data_base);
    // $db->create();
    // $db->store("Task", 1, "Probando", "Esto es una prueba");
    var_dump($db->index("Task"))
?>
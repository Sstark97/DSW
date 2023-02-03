<?php
    require_once "functions.php";

    if(isset($_GET["id"])){
        $user_id = $_GET["id"];
        $result = deleteUser($user_id);
    }

    echo createContactsTable()
?>

<?php
    $name = $_REQUEST["name"];
    $surname = $_REQUEST["surname"];
    $phone = $_REQUEST["phone"];

    echo json_encode("Hola tus datos son:\nNombre: $name \nApellidos: $surname \nTeléfono: $phone");
?>

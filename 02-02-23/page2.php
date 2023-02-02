<?php
    require_once "functions.php";

    $island_id = $_GET["id"];
    $result = getVillages($island_id);
    $villages = $result["villages"];
    $error = $result["error"];

    foreach($villages as $village){
        [
            "name" => $name, 
        ] = $village;
        echo "<option value='$name'>$name</option>";
    }
?>

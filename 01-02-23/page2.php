<?php
    require_once "functions.php";
    
    $result = getCustomers();
    $customers = $result["customers"];
    $error = $result["error"];

    foreach($customers as $customer){
        [
            "name" => $name, 
            "surname" => $surname, 
            "phone" => $phone
        ] = $customer;

        echo "<p>$name $surname $phone</p>";
    }
?>

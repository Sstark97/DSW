<?php
    include "functions.php";

    $error = "";
    $config = include './config.php';
    $userId = $_GET["userId"];

    try {
        [
            "host" => $host,
            "user" => $user,
            "pass" => $pass,
            "name" => $name,
            "options" => $options
        ] = $config["db"];
    
        $connection = new PDO("mysql:host=$host;dbname=$name", $user, $pass, $options);
        $sql_query = "DELETE FROM Students WHERE id = $userId";

        $sentence = $connection->prepare($sql_query);
        $sentence->execute();
        header("Location: index.php");
    } catch (PDOException $pdo_error) {
        $error = $pdo_error->getMessage();
    }
?>

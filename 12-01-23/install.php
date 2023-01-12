<?php

$config = include './config.php';

try {
    [
        "host" => $host,
        "user" => $user,
        "pass" => $pass,
        "options" => $options
    ] = $config["db"];

    $connection = new PDO("mysql:host=$host", $user, $pass, $options);
    $sql = file_get_contents('data/bbdd.sql');
    $connection->exec($sql);
    echo "The DataBase and Student Table created success";
} catch (PDOException $error) {
    echo $error->getMessage();
}

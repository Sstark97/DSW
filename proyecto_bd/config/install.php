<?php

require_once "config.php";

$config = getDbConfig();

try {
    [
        "host" => $host,
        "options" => $options
    ] = $config["db"];

    /**
     * Uso root porque en mi casa me daba fallo al crear
     * la base de datos, para todo lo demás uso la configuración
     * de mi usuario
     */
    $connection = new PDO("mysql:host=$host", "root", "", $options);
    $sql = file_get_contents('data/bbdd.sql');
    $connection->exec($sql);
    echo "The DataBase and all Table created success";
} catch (PDOException $error) {
    echo $error->getMessage();
}

<?php

/**
 * Función que devuelve los parámetros de conexión
 * a la base de datos
 * 
 * @return array asociativo con las opciones de conexión
 */
function getDbConfig()
{
    return [
        'db' => [
            'host' => 'localhost',
            'user' => 'aitor97',
            'pass' => '12345',
            'name' => 'GameShop',
            'options' => [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            ],
        ],
    ];
}

/**
 * Función que devuelve la conexión con la
 * BD School en base a las configuraciones definidas
 * en el fichero ./config/config.php
 *
 * Los posibles fallos a la hora de crear la conexión
 * están controlados en las funciones que interactúan con
 * la BD
 *
 * @return connection: Conexión a la BD School
 */
function getDbConnection()
{
    $config = getDbConfig();
    [
        "host" => $host,
        "user" => $user,
        "pass" => $pass,
        "name" => $name,
        "options" => $options,
    ] = $config["db"];

    $connection = new PDO("mysql:host=$host;dbname=$name", $user, $pass, $options);

    return $connection;
}

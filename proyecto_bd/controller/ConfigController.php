<?php

/**
 * Espacio de Nombre para todos los controladores
 */
namespace Controller;

use PDO;

/**
 * Maneja la Configuración de la BD
 * 
 * Clase que maneja la configuración de la BD,
 * devolviendo su configuración y su instancia
*/
class ConfigController {
    /**
     * Conexión a la BD
     * 
     * Función que devuelve los parámetros de conexión
     * a la base de datos
     * 
     * @return array asociativo con las opciones de conexión
     */
    public static function getDbConfig()
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
     * Conexión con la BD School
     *
     * Función que devuelve la conexión a la BD en base a 
     * las configuraciones definidas en el fichero ./config/config.php.
     * Los posibles fallos a la hora de crear la conexión
     * están controlados en las funciones que interactúan con
     * la BD
     *
     * @return PDO conexión a la BD School
     */
    public static function getDbConnection()
    {
        $config = self::getDbConfig();
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

}
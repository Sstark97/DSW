<?php
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
    function getDbConnection () {
        $config = include 'config.php';
        [
            "host" => $host,
            "user" => $user,
            "pass" => $pass,
            "name" => $name,
            "options" => $options
        ] = $config["db"];
    
        $connection = new PDO("mysql:host=$host;dbname=$name", $user, $pass, $options);
        
        return $connection;
    }
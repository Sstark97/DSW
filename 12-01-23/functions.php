<?php

    function htmlCodifier ($html) {
        return htmlspecialchars($html, ENT_QUOTES | ENT_SUBSTITUTE, "UTF-8");
    }

    function getDbConnection () {
        $config = include 'config/config.php';
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
?>
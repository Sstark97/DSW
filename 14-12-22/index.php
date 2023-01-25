<?php
try {
    $mysqli2 = new mysqli("localhost", "sstark97", "password", "test");
    echo "Conexión Exitosa! 😊";
} catch (Exception $e){
    echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    echo $mysqli->host_info . "\n";
}

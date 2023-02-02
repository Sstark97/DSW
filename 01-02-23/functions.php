<?php
require_once "config/functions.php";

/**
 * Función que devuelve los clientes de la BD supermarket
 * o devuelve un fallo en caso de haberlo
 * 
 * @return result: Resultado de ejecutar la consulta
*/
function getCustomers () {
    $result = [
        "error" => "",
        "sentence" => "",
        "customers" => []
    ];

    try {
        $connection = getDbConnection();

        $sql_query = "SELECT * FROM Customer";

        $sentence = $connection->prepare($sql_query);
        $sentence->execute();
        $customers = $sentence->fetchAll(PDO::FETCH_ASSOC);

        $result["sentence"] = $sentence;
        $result["customers"] = $customers;
    } catch (PDOException $pdo_error) {
        $result["error"] = $pdo_error->getMessage();
    }

    return $result;
}
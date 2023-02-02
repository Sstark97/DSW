<?php
require_once "config/functions.php";

/**
 * Función que devuelve los clientes de la BD supermarket
 * o devuelve un fallo en caso de haberlo
 * 
 * @return result: Resultado de ejecutar la consulta
*/
function getIslands () {
    $result = [
        "error" => "",
        "sentence" => "",
        "islands" => []
    ];

    try {
        $connection = getDbConnection();

        $sql_query = "SELECT * FROM Island";

        $sentence = $connection->prepare($sql_query);
        $sentence->execute();
        $islands = $sentence->fetchAll(PDO::FETCH_ASSOC);

        $result["sentence"] = $sentence;
        $result["islands"] = $islands;
    } catch (PDOException $pdo_error) {
        $result["error"] = $pdo_error->getMessage();
    }

    return $result;
}

/**
 * Función que devuelve los clientes de la BD supermarket
 * o devuelve un fallo en caso de haberlo
 * 
 * @return result: Resultado de ejecutar la consulta
*/
function getVillages (int $id) {
    $result = [
        "error" => "",
        "sentence" => "",
        "villages" => []
    ];

    try {
        $connection = getDbConnection();

        $sql_query = "SELECT * FROM Village WHERE islandId= :islandId";

        $sentence = $connection->prepare($sql_query);
        $sentence->bindParam(":islandId", $id, PDO::PARAM_INT);
        $sentence->execute();
        $villages = $sentence->fetchAll(PDO::FETCH_ASSOC);

        $result["sentence"] = $sentence;
        $result["villages"] = $villages;
    } catch (PDOException $pdo_error) {
        $result["error"] = $pdo_error->getMessage();
    }

    return $result;
}
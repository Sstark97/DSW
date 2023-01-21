<?php 
require_once "general.php";
require_once "config/config.php";

function getAllGames () {
    try {
        $connection = getDbConnection();

        $sql_query = "SELECT * FROM VideoGame";

        $sentence = $connection->prepare($sql_query);

        $sentence->execute();
        $games = $sentence->fetchAll(PDO::FETCH_ASSOC);

        return $games;
    } catch (PDOException $error) {
        return createErrors($error->getMessage());
    }
}

<?php
    include "functions.php";

    $error = "";
    $userId = $_GET["userId"];

    try {
        $connection = getDbConnection();
        $sql_query = "DELETE FROM Students WHERE id = $userId";

        $sentence = $connection->prepare($sql_query);
        $sentence->execute();
        header("Location: index.php");
    } catch (PDOException $pdo_error) {
        $error = $pdo_error->getMessage();
    }
?>

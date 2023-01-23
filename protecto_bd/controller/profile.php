<?php

require_once "general.php";

define("gravatar_uri", "https://www.gravatar.com/avatar/");

function generateUserProfileImg (string $email) {
    $hash = md5( strtolower( trim( $email ) ) );

    return gravatar_uri . $hash;
}

function getUserData () {
    $user_id = $_SESSION["userId"] ?? "";

    if(!empty($user_id)) {
        try {
            $connection = getDbConnection();

            $sql_query = "SELECT * FROM User WHERE dni = :dni";
    
            $sentence = $connection->prepare($sql_query);
            $sentence->bindValue(":dni", $user_id, PDO::PARAM_STR);
    
            $sentence->execute();

            $user_data = $sentence->fetch(PDO::FETCH_ASSOC);

            return $user_data;

        } catch (PDOException $error) {
            return createErrors($error->getMessage());
        }
    }
}
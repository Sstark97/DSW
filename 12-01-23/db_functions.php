<?php
    require_once "functions.php";

    function create () {
        $result = [
            "error" => false,
            "message" => "User add success!"
        ];

        try {
            $connection = getDbConnection();

            $student = [
                "name" => $_POST["name"],
                "surname" => $_POST["surname"],
                "email" => $_POST["email"],
                "age" => $_POST["age"]
            ];

            $sql_query = "INSERT INTO Students (name, surname, email, age)";
            $sql_query .= "values (:" . implode(", :", array_keys($student)) . ")";

            $sentence = $connection->prepare($sql_query);
            $sentence->execute($student);
        } catch (PDOException $error) {
            $result["error"] = true;
            $result["message"] = $error->getMessage();
        }

        return $result;
    }
?>
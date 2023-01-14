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

    function getStudent () {
        $userId = $_GET["userId"];

        $result = [
            "get_error_student" => "",
        ];

        try {
            $connection = getDbConnection();
            $sql_query = "SELECT * FROM Students WHERE id = $userId";
    
            $sentence = $connection->prepare($sql_query);
            $sentence->execute();
            $student = $sentence->fetch();
            $result["student"] = $student;
        } catch (PDOException $error) {
            $result["get_error_student"] = $error->getMessage();
        }

        return $result;
    }

    function edit () {
        $userId = $_GET["userId"];

        $result = [
            "error" => false,
            "message" => "User Updated success!"
        ];

        try {
            $connection = getDbConnection();

            $student = [
                "name" => $_POST["name"],
                "surname" => $_POST["surname"],
                "email" => $_POST["email"],
                "age" => intval($_POST["age"]),
                "age" => $_POST["age"],
                "id" => $userId
            ];
            
            $sql_query = <<< END
                UPDATE Students
                SET name=:name,
                surname=:surname,
                email=:email,
                age=:age
                WHERE id=:id
            END;

            $sentence = $connection->prepare($sql_query);

            foreach($student as $key => $field) {
                $type = $key === "id" || $key === "age" ? PDO::PARAM_INT : PDO::PARAM_STR;

                $sentence->bindValue(":$key", $field, $type);
            }

            $sentence->execute();
        } catch (PDOException $error) {
            $result["error"] = true;
            $result["message"] = $error->getMessage();
        }

        return $result;
    }
?>
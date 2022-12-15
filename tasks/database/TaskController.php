<?php
    class TaskController {
        private $connect;
        /**
         * Class constructor.
         */
        public function __construct(string $host, string $user_name, string $password, string $data_base)
        {
            try {
                $this-> connect = new mysqli($host, $user_name, $password, $data_base);
            } catch (Exception $e) {
                echo "Fallo de conexión $e";
            }
        }

        function index(string $table): array {
            $db = $this->connect;
            $sentence = $db->prepare("SELECT * FROM $table");
            $sentence->execute();
            $sentence->bind_result($id, $name, $description, $finish);
            $tasks = [];

            while(!$sentence->fetch()) {
                $tasks[$id] = [
                    "name" => $name,
                    "description" => $description,
                    "finish" => $finish
                ];

                echo $id;
            }

            $sentence->close();
            return $tasks;
        }

        function create() {
            $db = $this->connect;
            $sentence = $db->prepare("CREATE TABLE Task (
                Id INT PRIMARY KEY,
                Name VARCHAR(200) NOT NULL,
                Description VARCHAR(250),
                Finish INT DEFAULT 1
            )");
            $sentence->execute();
            $sentence->close();
        }
        
        function store(string $table, int $id, string $name, string $description) {
            $db = $this->connect;
            $sentence = $db->prepare("INSERT INTO $table(Id,Name,Description) VALUES (?,?,?)");
            $sentence->bind_param("iss",$id, $name, $description);
            $sentence->execute();
            $sentence->fetch();
            $task = [
                "name" => $name,
                "description" => $description,
                "finish" => $finish
            ];

            $sentence->close();
            return $task;
        }

        function show(string $table, int $id) {
            $db = $this->connect;
            $sentence = $db->prepare("SELECT * FROM $table WHERE Id = $id");
            $sentence->execute();
            $sentence->bind_result($id, $name, $description, $finish);      
            $sentence->fetch();

            $task = [
                "name" => $name,
                "description" => $description,
                "finish" => $finish
            ];

            $sentence->close();
            return $task;
        }
        
        function update(string $table, string $data, string $cond) {
            $db = $this->connect;
            $sentence = $db->prepare("UPDATE $table SET $data WHERE $cond");
            $sentence->execute();
            $result->bind_result($id, $name, $description, $finish);      
            $task = $sentence->fetch();

            $sentence->close();
            return $task;
        }
        
        function destroy(string $table, string $cond) {
            $db = $this->connect;
            $sentence = $db->prepare("DELETE FROM $table WHERE $cond");
            $sentence->execute();
            $result->bind_result($id, $name, $description, $finish);      
            $task = $sentence->fetch();

            $sentence->close();
            return $task;  
        }
    }
?>
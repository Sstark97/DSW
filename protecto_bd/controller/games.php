<?php
$config = strpos($_SERVER["PHP_SELF"], "pages") !== false ? "../config/config.php" : "config/config.php";
require_once $config;
require_once "general.php";

define("keys", ["name", "description", "genre", "price", "assesment", "release_date"]);

// Función donde se realizan las validaciones de los datos si no están vacíos
function validateGameForm () {
    $message = "";
    [
        "genre" => $genre,
        "price" => $price,
        "assesment" => $assesment,
        "release_date" => $release_date
    ] = $_POST["game"];

    if(!filter_var($price, FILTER_VALIDATE_FLOAT)) {
        $message .= "<p class='m-0 mb-2'>El precio debe ser un número con dos decimales</p>";
    }
    
    if(!filter_var($assesment, FILTER_VALIDATE_FLOAT)) {
        $message .= "<p class='m-0 mb-2'>La valoración debe ser un número con dos decimales</p>";
    } else if($assesment < 0 || $assesment > 6) {
        $message .= "<p class='m-0 mb-2'>La valoración debe estar entre 0 y 6</p>";
    }

    if(!preg_match("/\d{4}[-](0[1-9]|1[012])[-](0[1-9]|[12]\d|3[01])/",$release_date)) {
        $message .= "<span>La fecha de lanzamiento no cumple con el formato de Fecha</span>";
    }
    
    return $message;
}

/**
 * Función que saca todos los elementos
 * de la tabla VideoGame en forma de
 * array asociativo
 *
 * @return array $games
 */
function getAllGames()
{
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

/**
 * Función que crea un juego en la BD GameShop
 * o devuelve un fallo en caso de haberlo
 *
 * @return result: Resultado de ejecutar la consulta
 */
function createGame() {

    try {
        $connection = getDbConnection();

        [
            $sanitize_name, 
            $sanitize_description, 
            $sanitize_genre, 
            $sanitize_price, 
            $sanitize_assesment, 
            $sanitize_release_date
        ] = sanitizeFields($_POST["game"]);

        $game = [
            "name" => $sanitize_name,
            "description" => $sanitize_description,
            "genre" => $sanitize_genre,
            "price" => $sanitize_price,
            "assesment" => $sanitize_assesment,
            "release_date" => $sanitize_release_date
        ];

        $sql_query = <<< END
            INSERT INTO VideoGame (name, description, genre, price, assesment, release_date) VALUES 
            (:name, :description, :genre, :price, :assesment, :release_date)
        END;

        $sentence = $connection->prepare($sql_query);

        foreach($game as $key => $field) {
            $sentence->bindValue(":$key", $field, PDO::PARAM_STR);
        }

        $sentence->execute();
        header("Location: ../index.php");
        exit();

    } catch (PDOException $error) {
        return createErrors($error->getMessage());
    }
}

// Función que comprueba los errores y realiza la acción de registro
function gamesAction () {
    $is_ok = comprobeFields($_POST["game"], keys);
    $message = $is_ok ? createErrors("Existen campos vacíos o campos de más", true) : validateGameForm();

    if(empty($message) && !$is_ok ) {
        $message = createGame();
    } else if(!empty($message) && !$is_ok) {
        $message = createErrors($message);
    }

    return $message;
}
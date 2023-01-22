<?php

require_once "config/config.php";

/**
 * Función que saca todos los elementos
 * de la tabla VideoGame en forma de
 * array asociativo
 *
 * @return array $games
 */
function getPopularGames()
{
    try {
        $connection = getDbConnection();

        $sql_query = "SELECT * FROM VideoGame WHERE assesment > 4.5 LIMIT 8";

        $sentence = $connection->prepare($sql_query);

        $sentence->execute();
        $games = $sentence->fetchAll(PDO::FETCH_ASSOC);

        return $games;
    } catch (PDOException $error) {
        return createErrors($error->getMessage());
    }
}

/**
 * Función que añade un videojuego a la 
 * lista de deseados de un usuario
 * 
 * @return string error si lo hubiera
 */
function addToTheWhishList () {
    $user_id = $_SESSION["userId"] ?? "";
    $game_id = $_POST["gameId"] ?? "";

    if(!empty($user_id) && !empty($game_id)) {
        try {
            $connection = getDbConnection();

            $sql_query = "INSERT INTO WhisList(dni, gameId) VALUES (:dni, :gameId)";
    
            $sentence = $connection->prepare($sql_query);
            $sentence->bindValue(":dni", $user_id, PDO::PARAM_STR);
            $sentence->bindValue(":gameId", $game_id, PDO::PARAM_INT);
    
            $sentence->execute();

        } catch (PDOException $error) {
            return createErrors($error->getMessage());
        }
    }
}

/**
 * Función que elimina un videojuego de la 
 * lista de deseados de un usuario
 * 
 * @return string error si lo hubiera
 */
function deleteToTheWhishList () {
    $user_id = $_SESSION["userId"] ?? "";
    $game_id = $_POST["gameId"] ?? "";

    if(!empty($user_id) && !empty($game_id)) {
        try {
            $connection = getDbConnection();

            $sql_query = "DELETE FROM WhisList WHERE dni = :dni AND gameId = :gameId";
    
            $sentence = $connection->prepare($sql_query);
            $sentence->bindValue(":dni", $user_id, PDO::PARAM_STR);
            $sentence->bindValue(":gameId", $game_id, PDO::PARAM_INT);
    
            $sentence->execute();

        } catch (PDOException $error) {
            return createErrors($error->getMessage());
        }
    }
}

/**
 * Función que comprueba si un videojuego está en la 
 * lista de deseados de un usuario
 * 
 * @return string error si lo hubiera
 */
function isElementInWhishList (int $id) {
    $user_id = $_SESSION["userId"] ?? "";

    if(!empty($user_id)) {
        try {
            $connection = getDbConnection();

            $sql_query = "SELECT gameId FROM WhisList WHERE dni = :dni AND gameId = :gameId";
    
            $sentence = $connection->prepare($sql_query);
            $sentence->bindValue(":dni", $user_id, PDO::PARAM_STR);
            $sentence->bindValue(":gameId", $id, PDO::PARAM_INT);
    
            $sentence->execute();

            ["gameId" => $game_id] = $sentence->fetch(PDO::FETCH_ASSOC);

            return $game_id === $id;
        } catch (PDOException $error) {
            return createErrors($error->getMessage());
        }
    }
}

/**
 * Función que maneja las acciones sobre la
 * lista de deseados de un usuario
 */

function whishListAction () {
    $game_id = $_POST["gameId"] ?? "";
    $game_is_in_whish_list = isElementInWhishList($game_id);

    if($game_is_in_whish_list) {
        deleteToTheWhishList();
    } else {
        addToTheWhishList();
    }

}

/**
 * Función que crea un Card por cada videojuego
 * popular
 * 
 * @return string Código HTML con los datos del videojuego
 */
function cardGame (array $game) {
    [
        "id" => $id,
        "name" => $name, 
        "genre" => $genre, 
        "img" => $img, 
        "assesment" => $assesment
    ] = $game;

    $action = $_SERVER["PHP_SELF"];

    /**
     * Comprobamos si está en la lista de deseados
     * para colocar el icono correspondiente según sea
     * el caso
     */
    $game_is_in_whish_list = isElementInWhishList($id);
    $icon = $game_is_in_whish_list ? "fa-solid" : "fa-regular";

    return <<< END
    <div class="col-lg-3 col-sm-6">
        <div class="item">
            <img src="$img" alt="$name">
            <h4>$name<br><span>$genre</span></h4>
            <ul>
                <li><i class="fa fa-star"></i>$assesment</li>
                <li>
                    <form method="post" action="$action" >
                        <button name="add_wish_list"  class="bg-transparent border border-0"><i class="$icon fa-heart"></i></button>
                        <input type="hidden" value="$id" name="gameId" />
                    </form>
                </li>
            </ul>
        </div>
    </div>
    END;
}

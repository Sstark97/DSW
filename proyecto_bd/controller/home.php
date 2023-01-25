<?php

/**
 * Determinamos a que nivel dentro del árbol de 
 * directorios nos encontramos, para definir correctamente
 * el path para los ficheros requeridos
 */
$config = strpos($_SERVER["PHP_SELF"], "pages") !== false ? "../config/config.php" : "config/config.php";

require_once $config;

/**
 * Extrae los videojuegos populares
 * 
 * Función que saca todos los elementos
 * de la tabla VideoGame en forma de
 * array asociativo
 *
 * @return mixed
 * @return array videojuegos populartes
 * @return string posibles errores
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
 * Agrega un Videojuego a la lista de deseados
 * 
 * Función que añade un videojuego a la 
 * lista de deseados de un usuario
 * 
 * @global $_SESSION
 * @global $_POST
 * @return mixed
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
 * Elimina un Videojuego de la lista de deseados
 * 
 * Función que elimina un videojuego de la 
 * lista de deseados de un usuario
 * 
 * @global $_SESSION
 * @global $_POST
 * @return mixed
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
 * Comprueba si un Videojuego está en la lista de deseados
 * 
 * Función que comprueba si un videojuego está en la 
 * lista de deseados de un usuario
 * 
 * @global $_SESSION
 * @param int $id 
 * @return mixed si está o no en la lista o error si lo hubiera
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

            return $game_id == $id;
        } catch (PDOException $error) {
            return createErrors($error->getMessage());
        }
    }
}

/**
 * Devuelve la lista de deseados
 * 
 * Función que devuelve la lista de videojuegos 
 * deseados de un usuario
 * 
 * @global $_SESSION 
 * @param int $limit limite de elementos a extraer
 * @return mixed lista de deseados | error si lo hubiera
 */
function getWhishList (int $limit = 0) {
    $user_id = $_SESSION["userId"] ?? "";

    if(!empty($user_id)) {
        try {
            $connection = getDbConnection();

            $sql_query = "
                SELECT * FROM VideoGame 
                INNER JOIN WhisList
                ON VideoGame.id = WhisList.gameId 
                WHERE WhisList.dni = :dni
            ";

            $sql_query .= $limit !== 0 ? "LIMIT $limit" : "";
    
            $sentence = $connection->prepare($sql_query);
            $sentence->bindValue(":dni", $user_id, PDO::PARAM_STR);
    
            $sentence->execute();

            $games_in_whish_list = $sentence->fetchAll(PDO::FETCH_ASSOC);

            return $games_in_whish_list;
        } catch (PDOException $error) {
            return createErrors($error->getMessage());
        }
    }
}

/**
 * Maneja las acciones sobre la lista de deseados
 * 
 * Función que maneja las acciones sobre la
 * lista de deseados de un usuario
 * 
 * @global $_POST
 * @return void
 */

function whishListAction () {
    $game_id = $_POST["gameId"] ?? "";
    $game_is_in_whish_list = isElementInWhishList($game_id);

    if($game_is_in_whish_list) {
        deleteToTheWhishList();
    } else {
        addToTheWhishList();
    }

    header("Refresh: 0");

}

/**
 * Fragmento HTML con los datos de un Videojuego
 * 
 * Función que crea un Card por cada videojuego
 * popular con sus respectivos datos
 * 
 * @global $_SERVER
 * @param array datos del videojuego
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
    
    /**
     * Determinamos a que nivel dentro del árbol de 
     * directorios nos encontramos, para definir correctamente
     * el path para los ficheros requeridos
     */
    $path = strpos($_SERVER["PHP_SELF"], "pages") !== false ? "../" : "";
    $game_details = "{$path}pages/game.php?gameId=$id";

    return <<< END
    <a href="$game_details" class="col-lg-3 col-sm-6">
        <div class="item">
            <img src="$path$img" alt="$name">
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
    </a>
    END;
}

/**
 * Fragmento HTML con los datos de un Videojuego deseado
 * 
 * Función que crea un Card por cada videojuego
 * en la lista de deseados
 * 
 * @param array datos del videojuego
 * @return string Código HTML con los datos del videojuego
 */
function whishListItem (array $game) {
    [
        "name" => $name, 
        "genre" => $genre, 
        "img" => $img, 
        "price" => $price,
        "assesment" => $assesment,
        "release_date" => $release_date
    ] = $game;

    /**
     * Determinamos a que nivel dentro del árbol de 
     * directorios nos encontramos, para definir correctamente
     * el path para los ficheros requeridos
     */
    $path = strpos($_SERVER["PHP_SELF"], "pages") !== false ? "../" : "";

    return <<< END
    <div class="item">
        <ul>
            <li><img src="$path$img" alt="$name" class="templatemo-item"></li>
            <li>
                <h4>$name</h4><span>$genre</span>
            </li>
            <li>
                <h4>Fecha de Lanzamiento</h4><span>$release_date</span>
            </li>
            <li>
                <h4>Valoración</h4><span>$assesment</span>
            </li>
            <li>
                <h4>Precio</h4><span>$price</span>
            </li>
            <li>
                <div class="main-border-button"><a href="#">Comprar</a></div>
            </li>
        </ul>
    </div>
    END;
}
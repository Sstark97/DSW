<?php

require_once "config/config.php";

function cardGame (array $game) {
    ["name" => $name, "genre" => $genre, "img" => $img] = $game;

    return <<< END
    <div class="col-lg-3 col-sm-6">
        <div class="item">
            <img src="$img" alt="$name">
            <h4>$name<br><span>$genre</span></h4>
            <ul>
                <li><i class="fa fa-star"></i> 4.8</li>
                <li><i class="fa fa-download"></i> 2.3M</li>
            </ul>
        </div>
    </div>
    END;
}

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

        $sql_query = "SELECT * FROM VideoGame WHERE assesment > 4 LIMIT 8";

        $sentence = $connection->prepare($sql_query);

        $sentence->execute();
        $games = $sentence->fetchAll(PDO::FETCH_ASSOC);

        return $games;
    } catch (PDOException $error) {
        return createErrors($error->getMessage());
    }
}
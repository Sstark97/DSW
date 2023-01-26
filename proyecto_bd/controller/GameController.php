<?php
namespace Controller;

use PDO;
use PDOException;

class GameController {

    const GAME_KEYS = ["name", "description", "genre", "price", "assesment", "release_date"];

    /**
     * Valida los campos del formulario de Videojuegos
     * 
     * Función que valida todos los campos sensibles del videojuego,
     * como son el precio, la valoración y la fecha de lanzamiento
     * 
     * @global $_POST
     * @return string mensaje con todos los posibles errores
     */
    private static function validateGameForm () {
        $message = "";
        [
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
     * Extrae todos los videojugos existentes
     * 
     * Función que saca todos los elementos
     * de la tabla VideoGame en forma de
     * array asociativo
     *
     * @return mixed
     * @return array $games
     * @return string posibles errores
     */
    public static function getAllGames()
    {
        try {
            $connection = ConfigController::getDbConnection();
            $sql_query = "SELECT * FROM VideoGame";

            $sentence = $connection->prepare($sql_query);

            $sentence->execute();
            $games = $sentence->fetchAll(PDO::FETCH_ASSOC);

            return $games;
        } catch (PDOException $error) {
            return GeneralController::createErrors($error->getMessage());
        }
    }

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
    public static function getPopularGames()
    {
        try {
            $connection = ConfigController::getDbConnection();

            $sql_query = "SELECT * FROM VideoGame WHERE assesment > 4.5 LIMIT 8";

            $sentence = $connection->prepare($sql_query);

            $sentence->execute();
            $games = $sentence->fetchAll(PDO::FETCH_ASSOC);

            return $games;
        } catch (PDOException $error) {
            return GeneralController::createErrors($error->getMessage());
        }
    }

    /**
     * Extra los datos de un videojuego
     * 
     * Función que saca un elemento, en base
     * a su id,de la tabla VideoGame en forma de
     * array asociativo
     *
     * @param int $id del Videojuego a buscar
     * @return mixed
     * @return array $games
     * @return string posibles errores
     */
    public static function getGame(int $id)
    {
        try {
            $connection = ConfigController::getDbConnection();
            $sql_query = "SELECT * FROM VideoGame WHERE id = :id";

            $sentence = $connection->prepare($sql_query);
            $sentence->bindValue(":id", $id, PDO::PARAM_INT);

            $sentence->execute();
            $game = $sentence->fetch(PDO::FETCH_ASSOC);

            return $game;
        } catch (PDOException $error) {
            return GeneralController::createErrors($error->getMessage());
        }
    }

    /**
     * Extrae la imagen de un Videojuego
     * 
     * Función que devuelve la imagen actual
     * del videojuego que corresponda con el 
     * id pasado por parámetro
     * 
     * @param int $id del Videojuego a buscar
     * @return string resultado de la consulta
     */
    public static function getCurrentImg (int $id) {
        try {
            $connection = ConfigController::getDbConnection();
            $sql_query = "SELECT img FROM VideoGame WHERE id = :id";

            $sentence = $connection->prepare($sql_query);
            $sentence->bindValue(":id", $id, PDO::PARAM_INT);
            $sentence->execute();

            ["img" => $img] = $sentence->fetch(PDO::FETCH_ASSOC);

            return $img;
            
        } catch (PDOException $error) {
            return GeneralController::createErrors($error);
        }
    }

    /**
     * Inserta un nuevo Videojuego en la BD
     * 
     * Función que crea un juego en la BD GameShop
     * o devuelve un fallo en caso de haberlo
     *
     * @global $_POST
     * @return mixed
     * @return void
     * @return string posibles errores
     */
    public static function createGame() {

        try {
            $connection = ConfigController::getDbConnection();

            [
                $sanitize_name, 
                $sanitize_description, 
                $sanitize_genre, 
                $sanitize_price, 
                $sanitize_assesment, 
                $sanitize_release_date
            ] = GeneralController::sanitizeFields($_POST["game"]);

            $img = str_replace("../","", uploadImg());

            $game = [
                "name" => $sanitize_name,
                "description" => $sanitize_description,
                "genre" => $sanitize_genre,
                "img" => $img,
                "price" => $sanitize_price,
                "assesment" => $sanitize_assesment,
                "release_date" => $sanitize_release_date
            ];

            $sql_query = <<< END
                INSERT INTO VideoGame (name, description, genre, img, price, assesment, release_date) VALUES 
                (:name, :description, :genre, :img, :price, :assesment, :release_date)
            END;

            $sentence = $connection->prepare($sql_query);

            foreach($game as $key => $field) {
                $sentence->bindValue(":$key", $field, PDO::PARAM_STR);
            }

            $sentence->execute();
            AuthController::redirect("../index.php");

        } catch (PDOException $error) {
            return GeneralController::createErrors($error->getMessage());
        }
    }

    /**
     * Edita los datos de un Videojuego en la BD
     * 
     * Función que edita los datos de un juego en la BD GameShop
     * o devuelve un fallo en caso de haberlo
     *
     * @global $_POST
     * @param int $id del Videojuego a editar
     * @return mixed
     * @return void
     * @return string posibles errores
     */
    public static function editGame(int $id) {

        try {
            $connection = ConfigController::getDbConnection();

            [
                $sanitize_name, 
                $sanitize_description, 
                $sanitize_genre, 
                $sanitize_price, 
                $sanitize_assesment, 
                $sanitize_release_date
            ] = GeneralController::sanitizeFields($_POST["game"]);

            $previous_img = self::getCurrentImg($id);
            $img = str_replace("../", "", uploadImg($previous_img, true));

            $game = [
                "name" => $sanitize_name,
                "description" => $sanitize_description,
                "genre" => $sanitize_genre,
                "img" => $img,
                "price" => $sanitize_price,
                "assesment" => $sanitize_assesment,
                "release_date" => $sanitize_release_date,
                "id" => $id
            ];

            $sql_query = <<< END
                UPDATE VideoGame SET name = :name, description = :description,
                genre = :genre, img = :img, price = :price, assesment = :assesment, release_date = :release_date
                WHERE id = :id
            END;

            $sentence = $connection->prepare($sql_query);

            foreach($game as $key => $field) {
                $type = $key === "id" ? PDO::PARAM_INT : PDO::PARAM_STR;

                $sentence->bindValue(":$key", $field, $type);
            }

            $sentence->execute();
            AuthController::redirect("../index.php");

        } catch (PDOException $error) {
            return GeneralController::createErrors($error->getMessage());
        }
    }

    /**
     * Elimina un Videojuego de la BD
     * 
     * Función que elimina un juego en la BD GameShop
     * o devuelve un fallo en caso de haberlo
     *
     * @global $_GET
     * @return mixed
     */
    public static function deleteGame() {
        $id = $_GET["id"] ?? "";

        if(!empty($id)) {
            try {
                $connection = ConfigController::getDbConnection();
                $sql_query = "DELETE FROM VideoGame WHERE id = :id";

                // Borramos su imagen
                GameImgController::deleteGameImg($id);
        
                $sentence = $connection->prepare($sql_query);
                $sentence->bindValue(":id", $id, PDO::PARAM_INT);
                $sentence->execute();
        
                AuthController::redirect("../index.php");
        
            } catch (PDOException $error) {
                return GeneralController::createErrors($error->getMessage());
            }
        }
    }

    /**
     * Gestión de acciones sobre los Videojuegos
     * 
     * Función que comprueba los errores y realiza la acción
     * de agregar un nuevo juego o editarlo
     * 
     * @global $_GET
     * @global $_POST
     * @return string Resultado de la acción
     */
    public static function gamesAction () {
        $id = isset($_GET["id"]) ? $_GET["id"] : "";
        $is_ok = GeneralController::comprobeFields($_POST["game"], self::GAME_KEYS);
        $message = $is_ok 
            ? GeneralController::createErrors("Existen campos vacíos o campos de más", true) 
            : self::validateGameForm();

        if(empty($message) && !$is_ok ) {
            $message = !empty($id) ? self::editGame($id) : self::createGame();
        } else if(!empty($message) && !$is_ok) {
            $message = GeneralController::createErrors($message);
        }

        return $message;
    }

    /**
     * Fragmento HTML con la Tabla de Administración
     * 
     * Función que crea una tabla HTML con los 
     * videojuegos que existan en la BD
     * 
     * @return string Frágmento HTML de la Tabla
     */
    public static function createAdminTable () {
        $games = self::getAllGames();
        $tbody = "";
        
        // Si no hay videojuegos
        if(!is_array($games) || count($games) === 0) {
            return <<< END
                <form>
                    <h1 class='text-center mt-2'>No hay videojuegos</h1>
                </form>
            END;
        }

        // Creación de la Tabla
        foreach ($games as $game) {
            $id = "";
            foreach ($game as $key => $field) {
                $id .= $key === "id" ? $field : "";
                $tbody .= "<td>$field</td>";
            }
            
            $tbody .= <<< END
                <td>
                    <div class="text-center">
                        <a href="./pages/actionGame.php?id=$id" class="btn btn-warning">
                            <i class='fa fa-pencil'></i>
                        </a>
                        <a href="./pages/deleteGame.php?id=$id" class="btn btn-danger">
                            <i class='fa fa-trash'></i>
                        </a>
                    </div>
                </td>
            END;
            $tbody .= "</tr>";
        }

        return <<< END
            <table class="table table-bordered table-dark w-75 mx-auto mt-2">
                <thead>
                    <tr>
                        <td>Id</td>
                        <td>Nombre</td>
                        <td>Descripción</td>
                        <td>Género</td>
                        <td>Imagen</td>
                        <td>Precio</td>
                        <td>Valoración</td>
                        <td>Fecha de Lanzamiento</td>
                        <td>Acciones</td>
                    </tr>
                </thead>
                $tbody
            </table>
        END;
    }
}
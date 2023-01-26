<?php

namespace Controller;

use PDOException;

class GameImgController {
    /**
     * Borra la imagen de un juego
     * 
     * Función que borra la imagen de un juego
     * según el id pasado por parámetro
     * 
     * @param int $id del Videojuego a buscar
     * @return void
    */
    public static function deleteGameImg (int $id) {
        /**
         * Le concateno ../ ya que vamos a acceder
         * a la carpeta assets, donde se guardan todas
         * las imágenes
         */
        $img = "../" . GameController::getCurrentImg($id);
        if (file_exists($img)) {
            unlink($img);
        }
    }

    /**
     * Validación de la subida de una imagen
     * 
     * Función que comprueba los posibles errores a 
     * la hora de subir una imagen
     * 
     * @param array $img imagen a subir
     * @param bool $is_edit si estamos editando un fichero ya subido
     * @return string mensaje con los posibles errores
     */
    private static function comprobeImg (array $img, bool $is_edit = false) {
        ["error" => $error, "type" => $type] = $img;
        $message = "";
        $comprobe_files = $is_edit ? [...file_types, ""] : file_types;

        if(!in_array($type, $comprobe_files)){
            $message .= "<span>Solo se aceptan ficheros en formato jpg y png</span>";
        } else if (!empty($error)) {
            $message .= "<span>$error</span>";
        }

        return $message;
    }

    /**
     * Borra la imagen anterior 
     * 
     * Función que borra una imagen previa si la imagen
     * pasada como segundo parámetro es distinta de la 
     * pasada como primer parámetro
     * 
     * @param string ruta a la imagen previa
     * @param string directorio actual a comparar
     * @return void
     */
    private static function removePreviousImg (string $previous_img, string $img_dir) {
        /**
         * Le concateno ../ ya que vamos a acceder
         * a la carpeta assets, donde se guardan todas
         * las imágenes
         */
        $previous_img_format = "../$previous_img";

        if ($previous_img_format !== $img_dir && file_exists($previous_img_format)) {
            unlink($previous_img_format);
        }
    }

    /**
     * Subida de una imagen
     * 
     * Funcioón que se encarga de subir una imagen, comprobando antes
     * los posibles errores a la hora de subir una imagen
     *
     * @global $_FILES
     * @param string $previous_img ruta a la imagen previa
     * @param bool $is_edit si estamos subiendo una nueva imagen
     * @throws PDOException excepción generada si hay fallos a la hora de subir la imagen
     * @return string ruta de la imagen subida
     */
    public static function upload (string $previous_img = "", bool $is_edit = false) {
        $file = $_FILES["img"];
        
        $message = self::comprobeImg($file, $is_edit);

        // Si hay mensaje de error lo devolvemos
        if(!empty($message)) {
            throw new PDOException($message);
        }

        [ "name" => $name , "tmp_name" => $tmp_dir ] = $file;


        if(empty($name) && !empty($previous_img) && $is_edit) {
            return $previous_img;
        }

        $img_dir = "../assets/images/$name";

        if(!empty($previous_img) ) {
            self::removePreviousImg($previous_img, $img_dir);
        }

        move_uploaded_file($tmp_dir, $img_dir);

        return $img_dir;
    }
}
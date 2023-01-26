<?php

namespace Controller;
class AuthController {
    /**
     * Redirije a otra ruta
     * 
     * Función que redirige a la ruta pasada
     * por parámetro y se asegura de que no se 
     * ejecute nada más
     * 
     * @param string $location ruta a la que queremos dirigir
     * @return never
     */
    public static function redirect(string $location) {
        header("Location: $location");
        exit();
    }

    /**
     * Control de administrador 
     * 
     * Control para evitar que entren en esta página 
     * usuarios no esten logeados como admin
     * 
     * @global $_SESSION
     * @return void
    */
    public static function isAdmin () {
        if (!isset($_SESSION["userId"]) || isset($_SESSION["userId"]) && !$_SESSION["is_admin"]) {
            self::redirect("../index.php");
        }
    }

    /**
     * Comprueba si el usuario está logeado
     * 
     * Función que te redirige a inicio en
     * caso de que el id del usuario se
     * encuentre en la sesión
     * 
     * @global $_SESSION
     * @return void
     */
    public static function isLogged () {
        if (isset($_SESSION["userId"])) {
            self::redirect("../index.php");
        }
    }

    /**
     * Cerrar sesión
     * 
     * Función que destruye la sesión y te redirje
     * al login
     * 
     *@return void
    */
    public static function logout () {
        session_destroy();

        self::redirect("./pages/login.php");
    }

    /**
     * Redirecciona al login a usuarios sin logear
     * 
     * Función que te redirige al login en
     * caso de que el id del usuario se
     * no encuentre en la sesión
     * 
     * @global $_SESSION
     * @return void
     */
    public static function isNotLogged () {
        if (!isset($_SESSION["userId"])) {
            self::redirect("./pages/login.php");
        }
    }
}
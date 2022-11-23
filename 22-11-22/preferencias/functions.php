<?php

// Función que maneja las cookies en el index
function controlHome () {
    if(isset($_COOKIE["preferences"])) {
        header("Location: bienvenida.php");
    } else if(isset($_POST["submit"])) {
        setcookie("preferences", serialize($_POST["preferences"]));
        header("Location: bienvenida.php");
    }
}

// Función que maneja las cookies en la página de bienvenida
function controlWelcome () {
    if(isset($_POST["del_cookie"])) {
        setcookie("preferences", null, -1);
        header("Location: index.php");
    }

    $preferences = isset($_COOKIE["preferences"]) ? unserialize($_COOKIE["preferences"]) : [];
    if(count($preferences) === 0) {
        header("Location: index.php");
    }

    return $preferences;
}
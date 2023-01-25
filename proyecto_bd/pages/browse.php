<?php
    require_once "../controller/general.php";
    require_once "../controller/home.php";
    require_once "../controller/profile.php";

    session_name("videogames");
    session_start();

    isNotLogged();

    /**
     * Determinamos a que nivel dentro del árbol de 
     * directorios nos encontramos, para definir correctamente
     * el path para los ficheros requeridos
     */
    $path = strpos($_SERVER["PHP_SELF"], "pages") !== false ? "../" : "";

    $whish_list = getWhishList() ?? [];
?>

<?php include "../partials/header.php" ?>
    <h1>Browse</h1>
<?php include "../partials/footer.php" ?>
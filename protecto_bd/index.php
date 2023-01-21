<?php
    require_once "./partials/parts.php";

    session_name("videogames");
    session_start();

    if(!isset($_SESSION["userId"])) {
        header("Location: ./pages/login.php");
    }
?>

<?= createHeader() ?>
    <h1>Hola</h1>
<?= createFooter() ?>
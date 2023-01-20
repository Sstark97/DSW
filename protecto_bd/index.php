<?php
    require_once "./partials/parts.php";
    session_start();
    session_name();

    if(!isset($_SESSION["userId"])) {
        header("Location: ./pages/login.php");
    }
?>

<?= createHeader() ?>
    <h1>Hola</h1>
<?= createFooter() ?>
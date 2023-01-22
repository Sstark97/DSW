<?php
    require_once "../controller/games.php";

    session_name("videogames");
    session_start();

    /**
     * Control para evitar que entren en esta página 
     * usuarios no logeados o usuarios que no sean 
     * admin
     */
    if (!isset($_SESSION["userId"]) || isset($_SESSION["userId"]) && !$_SESSION["is_admin"]) {
        header("Location: ../index.php");
    }
?>

<?php include '../partials/header.php' ?>

    <?php if(isset($_POST["submit"])): ?>
        <?= gamesAction(); ?>
    <?php endif; ?>

    <?php include "../partials/gameForm.php" ?>
<?php include '../partials/footer.php' ?>
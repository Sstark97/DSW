<?php
    require_once "../controller/games.php";
    require_once "../controller/admin.php";

    session_name("videogames");
    session_start();

    // Controlamos si el usuario es admin
    isAdmin();
?>

<?php include '../partials/header.php' ?>

    <?php if(isset($_POST["submit"])): ?>
        <?= gamesAction(); ?>
    <?php endif; ?>

    <?php include "../partials/gameForm.php" ?>
<?php include '../partials/footer.php' ?>
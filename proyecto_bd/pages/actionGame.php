<?php
    require_once "../vendor/autoload.php";

    use Controller\AuthController;
    use Controller\GameController;

    session_name("videogames");
    session_start();

    // Controlamos si el usuario es admin
    AuthController::isAdmin();
?>

<?php include '../partials/header.php' ?>

    <?php if(isset($_POST["submit"])): ?>
        <?= GameController::gamesAction(); ?>
    <?php endif; ?>

    <?php include "../partials/gameForm.php" ?>
<?php include '../partials/footer.php' ?>
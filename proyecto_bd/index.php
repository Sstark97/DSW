<?php
    require_once "vendor/autoload.php";

    use Controller\AuthController;
    use Controller\ConfigController;

    session_name("videogames");
    session_start();

    AuthController::isNotLogged();
?>

<?php include 'partials/header.php' ?>
    <?php if(isset($_SESSION["is_admin"]) && $_SESSION["is_admin"]): ?>
        <?php include 'partials/adminContent.php' ?>
    <?php else: ?>
        <?php include 'partials/home.php' ?>
    <?php endif; ?>
<?php include 'partials/footer.php' ?>
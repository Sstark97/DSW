<?php
    session_name("videogames");
    session_start();

    if (!isset($_SESSION["userId"])) {
        header("Location: ./pages/login.php");
    }
?>

<?php include 'partials/header.php' ?>
    <?php if(isset($_SESSION["is_admin"])): ?>
        <?php include 'partials/adminContent.php' ?>
    <?php else: ?>
        <?php include 'partials/userContent.php' ?>
    <?php endif; ?>
<?php include 'partials/footer.php' ?>
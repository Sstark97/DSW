<?php
    session_name("videogames");
    session_start();

    if (!isset($_SESSION["userId"])) {
        header("Location: ./pages/login.php");
    }
?>

<?= include 'partials/header.php' ?>
    <?php if($_SESSION["is_admin"]): ?>
        <?= include 'partials/adminContent.php' ?>
    <?php else: ?>
        <?= include 'partials/userContent.php' ?>
    <?php endif; ?>
<?= include 'partials/footer.php' ?>
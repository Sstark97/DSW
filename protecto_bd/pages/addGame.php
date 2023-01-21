<?php
    session_name("videogames");
    session_start();

    if (isset($_SESSION["userId"]) && !$_SESSION["is_admin"]) {
        header("Location: ../index.php");
    }
?>

<?php include '../partials/header.php' ?>
    <h1>Hola</h1>
<?php include '../partials/footer.php' ?>
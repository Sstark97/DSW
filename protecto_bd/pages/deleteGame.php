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
    
    $id = isset($_GET["id"]) ? $_GET["id"] : "";
    $game = !empty($id) ? getGame($id) : [];
    $action = empty($id) ? $_SERVER['PHP_SELF'] : $_SERVER['PHP_SELF'] . "?id=$id";
?>

<?php include '../partials/header.php' ?>

    <?php if(isset($_POST["submit"])): ?>
        <?= deleteGame(); ?>
    <?php endif; ?>

    <form method="post" action="<?= $action ?>" class="d-flex flex-column align-items-center">
        <h2>¿Estas seguro de borrar <?= $game["name"] ?>?</h2>
        <button type="submit" name="submit" class="btn btn-danger w-25 mt-4">Borrar</button>
    </form>

<?php include '../partials/footer.php' ?>
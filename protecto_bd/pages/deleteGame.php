<?php
    require_once "../controller/games.php";
    require_once "../controller/admin.php";

    session_name("videogames");
    session_start();

    // Controlamos si el usuario es admin
    isAdmin();
    
    $id = isset($_GET["id"]) ? $_GET["id"] : "";
    $game = !empty($id) ? getGame($id) : [];
    $action = empty($id) ? $_SERVER['PHP_SELF'] : $_SERVER['PHP_SELF'] . "?id=$id";
    $empty_message = !empty($id) ? "No existe el juego con el id $id" : "Es necesario un id";
?>

<?php include '../partials/header.php' ?>

    <?php if(isset($_POST["submit"])): ?>
        <?= deleteGame(); ?>
    <?php endif; ?>

    <?php if(isset($game["name"])): ?>
        <form method="post" action="<?= $action ?>" class="d-flex flex-column align-items-center">
            <h2>¿Estas seguro de borrar <?= $game["name"] ?>?</h2>
            <button type="submit" name="submit" class="btn btn-danger w-25 mt-4">Borrar</button>
        </form>
    <?php else: ?>
        <h2 class="text-center"> <?= $empty_message ?> </h2>
    <?php endif; ?>

<?php include '../partials/footer.php' ?>
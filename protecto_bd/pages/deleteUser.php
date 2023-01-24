<?php
    require_once "../controller/games.php";
    require_once "../controller/profile.php";

    session_name("videogames");
    session_start();

    // Controlamos si el usuario es admin
    isNotLogged();
    
    $id = isset($_SESSION["userId"]) ? $_SESSION["userId"] : "";
    $user = getUserData() ?? [];
?>

<?php include '../partials/header.php' ?>

    <?php if(isset($_POST["submit"])): ?>
        <?= deleteUser(); ?>
    <?php endif; ?>

    <?php if(isset($user["name"])): ?>
        <form method="post" action="<?= $_SERVER["PHP_SELF"] ?>" class="d-flex flex-column align-items-center">
            <h2>¿Estas seguro de borrar <?= $user["name"] ?>?</h2>
            <button type="submit" name="submit" class="btn btn-danger w-25 mt-4">Borrar</button>
        </form>
    <?php else: ?>
        <h2 class="text-center">No hay usuario</h2>
    <?php endif; ?>

<?php include '../partials/footer.php' ?>
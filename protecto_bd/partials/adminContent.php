<?php
    require_once "controller/admin.php";
?>

<div class="page-content">
    <h1 class="text-center">Videojuegos</h1>
    <div class="d-flex justify-content-center my-4">
        <a href="../pages/addGame.php" class="btn btn-primary text-decoration-none text-white">Añadir videojuego</a>
    </div>
    <?= createAdminTable() ?>
</div>
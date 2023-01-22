<?php
    require_once "controller/admin.php";
?>

<!-- Pagina Inicial del Usuario Administrador -->
<h1 class="text-center">Videojuegos</h1>
<div class="d-flex justify-content-center my-4">
    <a href="../pages/actionGame.php" class="btn btn-primary text-decoration-none text-white">Añadir videojuego</a>
</div>
<?= createAdminTable() ?>
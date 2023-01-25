<?php
    require_once "../controller/general.php";
    require_once "../controller/games.php";
    require_once "../controller/home.php";

    session_name("videogames");
    session_start();

    isNotLogged();

    $games = getAllGames() ?? [];
?>

<?php include "../partials/header.php" ?>
    <?php if(isset($_POST["add_wish_list"])): ?>
        <?= whishListAction() ?>
    <?php endif; ?>

    <div class="most-popular browse">
        <div class="row">
            <div class="col-lg-12">
                <div class="heading-section">
                    <h4><em>Todos los Videojuegos</em> Ahora</h4>
                </div>
                <div class="row">
                
                    <!-- Renderizamos la lista de videojuegos populares -->
                    <?php if(count($games) !== 0): ?>
                        <?php foreach($games as $game ): ?>
                            <?= cardGame($game) ?>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <h2 class="text-center">No hay Videojuegos</h2>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
<?php include "../partials/footer.php" ?>
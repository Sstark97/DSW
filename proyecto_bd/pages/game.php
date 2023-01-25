<?php
    require_once "../controller/general.php";
    require_once "../controller/games.php";
    require_once "../controller/home.php";

    session_name("videogames");
    session_start();

    isNotLogged();

    $game_id = isset($_GET["gameId"]) ? $_GET["gameId"] : "";
    $game = empty($game_id) ? [] : getGame($game_id);
?>

<?php include "../partials/header.php" ?>
    <?php if(empty($game_id)): ?>
        <h1 class="text-center">Tienes que pasar un id de Videojuego</h1>
    <?php endif; ?>
    
    <?php if(!empty($game_id) && count($game) === 0): ?>
        <h1 class="text-center">No existe el VideoJuego con id <?= $game_id ?></h1>
    <?php else: ?>
        <div class="container">
            <div class="row">
                <div class="col-md-7">
                    <img src="../<?= $game["img"] ?>" alt="project-image" class="rounded">
                </div>
                <div class="col-md-5">
                    <div class="game_info mt-0">
                        <h2><?= $game["name"] ?></h2>
                        <p class="mb-0"><?= $game["description"] ?></p>
                    </div>

                    <div class="game_info mt-5">
                        <p><b>Género: </b><?= $game["genre"] ?></p>
                        <p><b>Fecha de Lanzamiento: </b> <?= $game["release_date"] ?></p>
                        <p><b>Precio: </b><?= $game["price"] ?>€</p>
                        <p><b>Valoración: </b> <?= $game["assesment"] ?></p>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
<?php include "../partials/footer.php" ?>
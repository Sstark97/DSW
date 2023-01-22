<?php
    require_once "../controller/games.php";

    $id = isset($_GET["id"]) ? $_GET["id"] : "";
    $title = empty($id) ? "Añadir" : "Editar";
    $game = empty($id) ? [] : getGame($id);
    $action = empty($id) ? $_SERVER['PHP_SELF'] : $_SERVER['PHP_SELF'] . "?id=$id";
?>

<div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="mt-4"><?= $title ?> Videojuego</h2>
            </div>
            <hr>
            <form class="text-white" method="post" action="<?= $action ?>">
                <div class="form-group">
                    <label for="game[name]">Nombre</label>
                    <input type="text" name="game[name]" class="form-control" value="<?= $game["name"] ?? "" ?>" >
                </div>
                <div class="form-group">
                    <label for="game[description]">Descripción</label>
                    <textarea name="game[description]"  rows="8" class="form-control"><?= $game["description"] ?? "" ?></textarea>
                </div>
                <div class="form-group">
                    <label for="game[genre]">Género</label>
                    <input type="text" name="game[genre]" class="form-control" value="<?= $game["genre"] ?? "" ?>">
                </div>
                <div class="form-group">
                    <label for="game[price]">Precio</label>
                    <input type="number" step=".01" name="game[price]" class="form-control" value="<?= $game["price"] ?? "4,99" ?>">
                </div>
                <div class="form-group">
                    <label for="game[assesment]">Popularidad</label>
                    <input type="number" step=".01" name="game[assesment]" class="form-control" value="<?= $game["assesment"] ?? "" ?>">
                </div>
                <div class="form-group">
                    <label for="game[release_date]">Fecha de lanzamiento</label>
                    <input type="date" name="game[release_date]" class="form-control" value="<?= $game["release_date"] ?? "" ?>">
                </div>
                <div class="form-group mt-3">
                    <button type="submit" name="submit[add]" class="btn btn-primary">Enviar</button>
                    <a class="btn btn-primary" href="../index.php">Regresar al inicio</a>
                </div>
            </form>
        </div>
    </div>
<div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="mt-4">Añadir Videojuego</h2>
            </div>
            <hr>
            <form class="text-white" method="post" action="<?= $_SERVER['PHP_SELF']?>">
                <div class="form-group">
                    <label for="game[name]">Nombre</label>
                    <input type="text" name="game[name]" class="form-control">
                </div>
                <div class="form-group">
                    <label for="game[description]">Descripción</label>
                    <textarea name="game[description]"  rows="8" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <label for="game[genre]">Género</label>
                    <input type="text" name="game[genre]" class="form-control">
                </div>
                <div class="form-group">
                    <label for="game[price]">Precio</label>
                    <input type="number" step=".01" value="4.99" name="game[price]" class="form-control">
                </div>
                <div class="form-group">
                    <label for="game[assesment]">Popularidad</label>
                    <input type="number" step=".01" name="game[assesment]" class="form-control">
                </div>
                <div class="form-group">
                    <label for="game[release_date]">Popularidad</label>
                    <input type="date" name="game[release_date]" class="form-control">
                </div>
                <div class="form-group mt-3">
                    <button type="submit" name="submit[add]" class="btn btn-primary">Enviar</button>
                    <a class="btn btn-primary" href="../index.php">Regresar al inicio</a>
                </div>
            </form>
        </div>
    </div>
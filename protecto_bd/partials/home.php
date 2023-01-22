<?php
    require_once "controller/home.php";

    $popular_games = getPopularGames() ?? [];
    $whish_list = getWhishList() ?? [];
?> 

<?php if(isset($_POST["add_wish_list"])): ?>
    <?= whishListAction() ?>
<?php endif; ?>

<!-- ***** Banner Start ***** -->
<div class="main-banner">
    <div class="row">
        <div class="col-lg-7">
            <div class="header-text">
                <h6>Bienvenido a Cyborg</h6>
                <h4><em>Busca</em> los videojuegos más populares aquí</h4>
                <div class="main-button">
                    <a href="browse.html">Busca ahora</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ***** Banner End ***** -->

<!-- ***** Most Popular Start ***** -->
<div class="most-popular">
    <div class="row">
        <div class="col-lg-12">
            <div class="heading-section">
                <h4><em>Los más Populares</em> Ahora</h4>
            </div>
            <div class="row">
            
                <!-- Renderizamos la lista de videojuegos populares -->
                <?php if(count($popular_games) !== 0): ?>
                    <?php foreach($popular_games as $game ): ?>
                        <?= cardGame($game) ?>
                    <?php endforeach; ?>
                <?php else: ?>
                    <h2 class="text-center">No hay juegos populares</h2>
                <?php endif; ?>
            
                <div class="col-lg-12">
                    <div class="main-button">
                        <a href="browse.html">Descubre más</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="gaming-library">
    <div class="col-lg-12">
        <div class="heading-section">
            <h4><em>Tu lista de</em> deseados</h4>
        </div>

        <!-- Renderizamos la lista de deseados -->
        <?php if(count($whish_list) !== 0): ?>
            <?php foreach($whish_list as $game): ?>
                <?= whishListItem ($game) ?>
            <?php endforeach; ?>
        <?php else: ?>
            <h2 class="text-center pb-5">No hay nada en la lista de Deseados</h2>
        <?php endif; ?>

    <div class="col-lg-12">
        <div class="main-button">
            <a href="profile.html">Ver la lista completa</a>
        </div>
    </div>
</div>
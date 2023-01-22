<?php
    require_once "controller/home.php";

    $popular_games = getPopularGames() ?? [];
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
<!-- ***** Most Popular End ***** -->

<!-- ***** Gaming Library Start ***** -->
<div class="gaming-library">
    <div class="col-lg-12">
        <div class="heading-section">
            <h4><em>Tu lista de</em> deseados</h4>
        </div>
        <div class="item">
            <ul>
                <li><img src="assets/images/game-01.jpg" alt="" class="templatemo-item"></li>
                <li>
                    <h4>Dota 2</h4><span>Sandbox</span>
                </li>
                <li>
                    <h4>Date Added</h4><span>24/08/2036</span>
                </li>
                <li>
                    <h4>Hours Played</h4><span>634 H 22 Mins</span>
                </li>
                <li>
                    <h4>Currently</h4><span>Downloaded</span>
                </li>
                <li>
                    <div class="main-border-button border-no-active"><a href="#">Donwloaded</a></div>
                </li>
            </ul>
        </div>
        <div class="item">
            <ul>
                <li><img src="assets/images/game-02.jpg" alt="" class="templatemo-item"></li>
                <li>
                    <h4>Fortnite</h4><span>Sandbox</span>
                </li>
                <li>
                    <h4>Date Added</h4><span>22/06/2036</span>
                </li>
                <li>
                    <h4>Hours Played</h4><span>740 H 52 Mins</span>
                </li>
                <li>
                    <h4>Currently</h4><span>Downloaded</span>
                </li>
                <li>
                    <div class="main-border-button"><a href="#">Donwload</a></div>
                </li>
            </ul>
        </div>
        <div class="item last-item">
            <ul>
                <li><img src="assets/images/game-03.jpg" alt="" class="templatemo-item"></li>
                <li>
                    <h4>CS-GO</h4><span>Sandbox</span>
                </li>
                <li>
                    <h4>Date Added</h4><span>21/04/2036</span>
                </li>
                <li>
                    <h4>Hours Played</h4><span>892 H 14 Mins</span>
                </li>
                <li>
                    <h4>Currently</h4><span>Downloaded</span>
                </li>
                <li>
                    <div class="main-border-button border-no-active"><a href="#">Donwloaded</a></div>
                </li>
            </ul>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="main-button">
            <a href="profile.html">Ver la lista completa</a>
        </div>
    </div>
</div>
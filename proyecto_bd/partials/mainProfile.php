<?php
    require_once "../controller/general.php";
    require_once "../controller/profile.php";
    require_once "../controller/home.php";

    $user_data = getUserData() ?? [];
    $whishlist_count = count(getWhishList()) ?? 0;
?>

<div class="main-profile ">
      <div class="row">
        <?= profileCard($whishlist_count) ?>
      </div>
      <div class="row">
        <div class="col-lg-12">
          <div class="clips">
            <div class="row">
              <div class="col-lg-12">
                <div class="heading-section">
                  <h4><em>Tus clips más </em> populares</h4>
                </div>
              </div>
              <div class="col-lg-3 col-sm-6">
                <div class="item">
                  <div class="thumb">
                    <img src="<?= $path ?>assets/images/clip-01.jpg" alt="" style="border-radius: 23px;">
                    <a href="https://www.youtube.com/watch?v=r1b03uKWk_M" target="_blank"><i class="fa fa-play"></i></a>
                  </div>
                  <div class="down-content">
                    <h4>Primero</h4>
                    <span><i class="fa fa-eye"></i> 250</span>
                  </div>
                </div>
              </div>
              <div class="col-lg-3 col-sm-6">
                <div class="item">
                  <div class="thumb">
                    <img src="<?= $path ?>assets/images/clip-02.jpg" alt="" style="border-radius: 23px;">
                    <a href="https://www.youtube.com/watch?v=r1b03uKWk_M" target="_blank"><i class="fa fa-play"></i></a>
                  </div>
                  <div class="down-content">
                    <h4>Segundo</h4>
                    <span><i class="fa fa-eye"></i> 183</span>
                  </div>
                </div>
              </div>
              <div class="col-lg-3 col-sm-6">
                <div class="item">
                  <div class="thumb">
                    <img src="<?= $path ?>assets/images/clip-03.jpg" alt="" style="border-radius: 23px;">
                    <a href="https://www.youtube.com/watch?v=r1b03uKWk_M" target="_blank"><i class="fa fa-play"></i></a>
                  </div>
                  <div class="down-content">
                    <h4>Tercero</h4>
                    <span><i class="fa fa-eye"></i> 141</span>
                  </div>
                </div>
              </div>
              <div class="col-lg-3 col-sm-6">
                <div class="item">
                  <div class="thumb">
                    <img src="<?= $path ?>assets/images/clip-04.jpg" alt="" style="border-radius: 23px;">
                    <a href="https://www.youtube.com/watch?v=r1b03uKWk_M" target="_blank"><i class="fa fa-play"></i></a>
                  </div>
                  <div class="down-content">
                    <h4>Cuarto</h4>
                    <span><i class="fa fa-eye"></i> 91</span>
                  </div>
                </div>
              </div>
              <div class="col-lg-12">
                <div class="main-button">
                  <a href="#">Cargar más</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
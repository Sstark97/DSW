<?php
    require_once "../controller/general.php";
    require_once "../controller/profile.php";


    $user_data = getUserData() ?? [];
?>

<div class="main-profile ">
      <div class="row">
        <div class="col-lg-4">
          <img src="<?= generateUserProfileImg($user_data["email"]) ?>" alt="<?= $user_data["email"] ?? "email" ?>" style="border-radius: 23px;">
        </div>
        <div class="col-lg-4 align-self-center">
          <div class="main-info header-text">
            <h4><?= $user_data["name"] ?? "name" ?></h4>
            <p><?= $user_data["surname"] ?? "surname" ?></p>
            <div class="main-border-button">
              <a href="#">Editar Perfil</a>
            </div>
            <div class="main-border-button">
              <a href="#">Borrar Cuenta</a>
            </div>
          </div>
        </div>
        <div class="col-lg-4 align-self-center">
          <ul>
            <li>Lista de Deseados<span><?= count($whish_list) ?></span></li>
            <li>Correo <span><?= $user_data["email"] ?? "email" ?></span></li>
            <li>Edad <span><?= $user_data["age"] ?? "age" ?></span></li>
            <li>Teléfono<span><?= $user_data["phone"] ?? "phone" ?></span></li>
          </ul>
        </div>
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
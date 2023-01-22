<?php
  require_once "../controller/login.php";
  require_once "../controller/general.php";

  session_name("videogames");
  session_start();

  //Comprobamos si el usuario está logeado
  isLogged();
  
?>

<?php include "../partials/notLoggedHeader.php" ?>
<section class="vh-100 gradient-custom">
    <?php if(isset($_POST["login_submit"])): ?>
      <?= loginAction() ?>
    <?php endif; ?>
    <div class="container pb-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
          <div class="card bg-dark text-white" style="border-radius: 1rem;">
            <div class="card-body p-5 text-center">

              <form class="mb-md-5 mt-md-4 pb-5" method="post" action="<?= $_SERVER["PHP_SELF"] ?>"> 

                <h2 class="fw-bold mb-2 text-uppercase">Login</h2>
                <p class="text-white-50 mb-5">Introduce tu email y contraseña!</p>

                <div class="form-outline form-white mb-4">
                  <label class="form-label" for="user[email]">Email</label>
                  <input type="email" name="user[email]" class="form-control form-control-lg" />
                </div>

                <div class="form-outline form-white mb-4">
                  <label class="form-label" for="user[password]">Password</label>
                  <input type="password" name="user[password]" class="form-control form-control-lg" />
                </div>

                <button class="btn btn-outline-light btn-lg px-5" type="submit" name="login_submit" >Login</button>

              </form>
              <div>
                <p class="mb-0">¿No tienes cuenta? <a href="./register.php" class="text-white-50 fw-bold">Sign Up</a>
                </p>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
<?php include "../partials/notLoggedFooter.php" ?>
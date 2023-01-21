<?php
  require_once "../partials/parts.php";
  require_once "../controller/register.php";
?>

<?= createNotLoggedHeader() ?>

<section class="vh-100 gradient-custom">
  <?php if(isset($_POST["register_submit"])): ?>
      <?= registerAction() ?>
  <?php endif; ?>
  <div class="container  h-75">
    <div class="row d-flex justify-content-center align-items-center h-100 pt-4">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card bg-dark text-white" style="border-radius: 1rem;">
          <div class="card-body p-5 pb-3 text-center">

            <form method="post" action="<?= $_SERVER["PHP_SELF"] ?>" >

              <h2 class="fw-bold mb-2 text-uppercase">Registro</h2>

              <div class="form-outline form-white mb-1">
                <label class="form-label" for="user[dni]">Dni</label>
                <input type="text" name="user[dni]" class="form-control" />
              </div>

              <div class="form-outline form-white mb-1">
                <label class="form-label" for="user[name]">Nombre</label>
                <input type="text" name="user[name]" class="form-control" />
              </div>
              <div class="form-outline form-white mb-1">
                <label class="form-label" for="user[surname]">Apellidos</label>
                <input type="text" name="user[surname]" class="form-control" />
              </div>

              <div class="form-outline form-white mb-1">
                <label class="form-label" for="user[email]">Email</label>
                <input type="email" name="user[email]" id="typeEmailX" class="form-control" required/>
              </div>

              <div class="form-outline form-white mb-1">
                <label class="form-label" for="user[phone]">Teléfono</label>
                <input type="text" name="user[phone]" class="form-control" required/>
              </div>

              <div class="form-outline form-white mb-1">
                <label class="form-label" for="user[age]">Edad</label>
                <input type="text" name="user[age]" class="form-control" />
              </div>

              <div class="form-outline form-white mb-1">
                <label class="form-label" for="user[password]">Contraseña</label>
                <input type="password" name="user[password]" id="typePasswordX" class="form-control" required/>
              </div>

              <button class="btn btn-outline-light btn-lg px-5" type="submit" name="register_submit">Únete!</button>

            </form>

            <div class="mt-3">
              <p class="mb-0">¿Tienes una cuenta? <a href="./login.php" class="text-white-50 fw-bold">Login</a>
              </p>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?= createFooter() ?>
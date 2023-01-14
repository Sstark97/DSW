<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD"
      crossorigin="anonymous"
    />
    <title>School</title>
  </head>
  <body>
    <main class="d-flex flex-column h-100 min-vw-100 min-vh-100">
      <header>
        <nav class="navbar navbar-dark bg-dark navbar-expand-lg py-4">
          <div class="container-fluid">
            <a class="navbar-brand">School</a>
            <button
              class="navbar-toggler"
              type="button"
              data-bs-toggle="collapse"
              data-bs-target="#navbarSupportedContent"
              aria-controls="navbarSupportedContent"
              aria-expanded="false"
              aria-label="Toggle navigation"
            >
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <form
                class="navbar-nav me-auto mb-2 mb-lg-0"
                action="./index.php"
                method="post"
              >
                <div class="nav-item">
                  <a class="nav-link me-3" href="create.php">
                    Crear alumno/a
                  </a>
                </div>
                <div class="nav-item">
                  <a class="nav-link me-3" href="show_users.php">
                    Mostrar alumnado/a
                  </a>
                </div>
              </form>
            </div>
          </div>
        </nav>
      </header>

<?php

function createHeader($contacts) {
    $json_contacts = json_encode($contacts);
    return <<< END
        <!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <!-- CSS only -->
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
            <link rel="stylesheet" href="./style.css">
            <title>Agenda</title>
        </head>
        <body>
            <main class="d-flex flex-column h-100 min-vw-100 min-vh-100 position-relative">
                <header>
                    <nav class="navbar navbar-expand-lg bg-primary py-3">
                        <div class="container-fluid">
                        <a class="navbar-brand" href="./index.php">Agenda</a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <form class="navbar-nav me-auto mb-2 mb-lg-0" action="./index.php" method="post">
                                <div class="nav-item">
                                        <input class="nav-link me-3" type="submit" name="action[]" value="Añadir contacto" />
                                </div>
                                <div class="nav-item">
                                        <input class="nav-link me-3" type="submit" name="action[]" value="Actualizar datos" />
                                </div>
                                <div class="nav-item">
                                    <input class="nav-link me-3" type="submit" name="action[]" value="Bloquear un Contacto" />
                                </div>
                                <div class="nav-item">
                                    <input class="nav-link me-3" type="submit" name="action[]" value="Mostrar todos los contactos" />
                                </div>
                                <div class="nav-item">
                                    <input class="nav-link me-3" type="submit" name="action[]" value="Subir datos Extra" />
                                </div>
                                <input type="hidden" name="contacts" value='$json_contacts'>
                            </form>
                        </div>
                    </div>
                    </nav>
                </header>
    END;
}

function createFooter() {
    return <<< END
            <footer class="bg-primary text-light w-100 text-center py-5 position-absolute bottom-0">
                Desarrollado por Aitor Santana Cabrera 2º de DAW de la Asignatura DSW
            </footer>
        </main>
    </body>
    </html>
    END;
}
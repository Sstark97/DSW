<?php

function createHeader() {
    
    return <<< END
        <!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <!-- CSS only -->
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
            <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
            <link rel="stylesheet" href="./style.css">
            <title>Agenda</title>
        </head>
        <body>
            <main class="d-flex flex-column h-100 min-vw-100 min-vh-100">
                <header>
                    <nav class="navbar navbar-dark bg-dark navbar-expand-lg py-4">
                        <div class="container-fluid">
                        <form class="navbar-nav me-auto mb-2 mb-lg-0" action="./index.php" method="post">
                            <div class="nav-item">
                                    <button class="navbar-brand me-3" type="submit" name="index">
                                        Agenda
                                    </button>
                            </div>
                            <input type="hidden" name="not_show">
                        </form>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <form class="navbar-nav me-auto mb-2 mb-lg-0" action="./index.php" method="post">
                                <div class="nav-item">
                                        <button class="nav-link me-3" type="submit" name="action[add]">
                                            Añadir Contacto
                                        </button>
                                </div>
                                <div class="nav-item">
                                    <button class="nav-link me-3" type="submit" name="action[block]">
                                        Bloquear Contacto
                                    </button>
                                </div>
                                <input type="hidden" name="not_show">
                            </form>
                        </div>
                    </div>
                    </nav>
                </header>
                <div class="w-100">
    END;
}

function createFooter() {
    return <<< END
            </div>
            <footer class="bg-dark text-light w-100 text-center mt-auto footer">
                Desarrollado por Aitor Santana Cabrera 2º de DAW de la Asignatura DSW
            </footer>
        </main>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    </body>
    </html>
    END;
}
<?php 
    /**
     * Determinamos a que nivel dentro del árbol de 
     * directorios nos encontramos, para definir correctamente
     * el path para los ficheros requeridos
     */
    $path = strpos($_SERVER["PHP_SELF"], "pages") !== false ? "../" : "";
?>

</div>
</div>
</div>
</main>
<footer>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <p>Copyright © 2036 <a href="#">Cyborg Gaming</a> Company. All rights reserved.

                    <br>Design: <a href="https://templatemo.com" target="_blank"
                        title="free CSS templates">TemplateMo</a> Distributed By <a href="https://themewagon.com"
                        target="_blank">ThemeWagon</a>
                </p>
            </div>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
    crossorigin="anonymous"></script>

<script src="<?= $path ?>assets/js/isotope.min.js"></script> -->
<script src="<?= $path ?>assets/js/owl-carousel.js"></script>
<script src="<?= $path ?>assets/js/tabs.js"></script>
<script src="<?= $path ?>assets/js/popup.js"></script> -->
<script src="<?= $path ?>assets/js/custom.js"></script>
</body>

</html>
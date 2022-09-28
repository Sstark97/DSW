<?php
    /*
        Realizar el programa “Hola Mundo” 
        pero añadiendo algo de estilo en PHP.
    */
    echo "
        <style>
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }

            html,body {
                width: 100vw;
                height: 100vh;
                background: #ed2d54;
            }
            .hello {
                display: grid;
                place-content: center;
                width:100%;
                height: 100%;
                font-size: 3rem;
            }
        </style>

        <div class='hello'>Hola Mundo</div>
    "
?>
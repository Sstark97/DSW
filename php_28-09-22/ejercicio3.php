<?php
    /*
        Realizar el programa “Hola Mundo” que contenga un enlace con el texto “Ir a la
        siguiente página” que abrirá una segunda página que dirá “Esta es la segunda página”
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

            a {
                font-size: 1.5rem;
                text-decoration: none;
                color: #000;
                text-align:center;
            }
        </style>

        <div class='hello'>

            <h1>Hola Mundo</h1>
            <a href='./ejercicio3.html' >Ir a la siguiente página</a>
        
        </div>
    "
?>
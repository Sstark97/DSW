<?php
    /*
        Realizar un programa en PHP que muestre un valor al azar entre 1 y 6 con las caras de
        un dado. Para ello puedes utilizar la función rand(valor_inicio, valor_final) y realizar la
        captura de seis imágenes de un dado para hacerlo más visual.
    */

    $random = rand(1,6);

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
            }

            div {
                display: grid;
                place-content: center;
                width:100%;
                height: 100%;
                font-size: 3rem;
            }

            img {
                width: 150px;
                height: 150px;
                object-fit: cover;
            }

        </style>
    ";
    echo "
            <div>
                <img src='dice$random.png'>
            </div>
    ";
?>
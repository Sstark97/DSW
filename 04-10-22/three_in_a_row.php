<?php

/*
    Realizar el juego del 3 en raya, donde habrá dos jugadores que tengan que hacer el 3 en raya, los
    signos serán la X y la O y cuando exista una posición vacía habrá un -. El tablero de juego será una
    matriz de 3x3 de tipo char. El juego termina cuando uno de los jugadores hace 3 en raya o si no hay
    más posiciones que poner. Para ello, el juego deberá solicitar a cada jugador actual donde quiere
    poner el valor (X o O dependiendo del jugador), ver si ya tiene el tres en raya y comprobar que no
    haya un valor en esa posición.
*/
    include "functions.php";

    $gameBoard = [["-", "-", "-"],["-", "-", "-"],["-", "-", "-"]];
    define("finishGame", ["Empate","Gana el jugador 1","Gana el jugador 2"]);
    $status = 0;
    $mov = 0;

    while($mov < 9) {
        $moveResult = movePlayer($gameBoard, $mov);

        $gameBoard[$moveResult[0]][$moveResult[1]] = $moveResult[2];
        $mov ++;
        printGame($gameBoard);
        $status = comprobeFinish($gameBoard, $mov);
        if($status !== 3) {
            break;
        }
    }  

    echo finishGame[$status];
?>
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

    $player1 = "X";
    $player2 = "O";
    $gameBoard = [["-", "-", "-"],["-", "-", "-"],["-", "-", "-"]];
    define("finishGame", ["Empate","Gana el jugador 1","Gana el jugador 2"]);
    $status = 0;

    while(true) {
        $player1Pos = movePlayer($gameBoard, $player1);
        $gameBoard[$player1Pos[0]][$player1Pos[1]] = $player1;
        printGame($gameBoard);
        $status = comprobeFinish($gameBoard);
        if($status !== 3) {
            break;
        }

        $player2Pos = movePlayer($gameBoard, $player2);
        $gameBoard[$player2Pos[0]][$player2Pos[1]] = $player2;
        printGame($gameBoard);
        $status = comprobeFinish($gameBoard);
        if($status !== 3) {
            break;
        }
    }  

    echo finishGame[$status]
    
?>
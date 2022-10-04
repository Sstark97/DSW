<?php

/*
    Realizar el juego del 3 en raya, donde habrá dos jugadores que tengan que hacer el 3 en raya, los
    signos serán la X y la O y cuando exista una posición vacía habrá un -. El tablero de juego será una
    matriz de 3x3 de tipo char. El juego termina cuando uno de los jugadores hace 3 en raya o si no hay
    más posiciones que poner. Para ello, el juego deberá solicitar a cada jugador actual donde quiere
    poner el valor (X o O dependiendo del jugador), ver si ya tiene el tres en raya y comprobar que no
    haya un valor en esa posición.
*/
    function comprobePos ($gameBoard,$xPos, $yPos) {
        return in_array([0,1,2], $xPos) && in_array([0,1,2], $yPos) && $gameBoard[$xPos][$yPos] === "-";
    }

    function comprobeFinish ($gameBoard) {
        $finish = false;
    }

    $player1 = "X";
    $player2 = "O";
    $gameBoard = [["-", "-", "-"],["-", "-", "-"],["-", "-", "-"]];
    $stopGame = false;

    // while(!stop) {
    //     $player1Mov1 = readline("Dime la primera posición en la quiere colocar su ficha (X)");
    //     $player1Mov2 = readline("Dime la segunda posición en la quiere colocar su ficha (X)");

    //     if(comprobePos($gameBoard,$player1Mov1, $player1Mov2)) {
    //         $gameBoard[$player1Mov1][$player1Mov2] = $player1;
    //         $player2Mov = readline("En que posición quiere colocar su ficha (0)");
    //         $player2Mov2 = readline("Dime la segunda posición en la quiere colocar su ficha (0)");

    //         if(comprobePos($gameBoard,$player2Mov1, $player2Mov2)) {
    //             $gameBoard[$player2Mov1][$player2Mov2] = $player2;
    //         } else {
    //             echo "Jugador 2 esa posición no es valida";
    //         }

    //     } else {
    //         echo "Jugador 1 esa posición no es valida";
    //     }
    // }

    echo strtr(json_encode($gameBoard),"],","]\n");
    

?>
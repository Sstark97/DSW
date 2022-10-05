<?php
function printGame($gameBoard)
{
    $size = count($gameBoard);

    for ($row = 0; $row < $size; $row++) {
        echo "[" . implode(" ", $gameBoard[$row]) . "]\n";
    }
}

function comprobePos($gameBoard, $xPos, $yPos)
{
    return isset($gameBoard[$xPos][$yPos]) && $gameBoard[$xPos][$yPos] === "-";
}

function movePlayer($gameBoard, $player)
{
    $stop = false;
    $numberPlayer = $player === "X" ? 1 : 2;

    while (!$stop) {
        $playerMov1 = readline("Jugador" . $numberPlayer . " dime la primera posición en la quiere colocar su ficha (" . $player . ")");
        $playerMov2 = readline("Jugador" . $numberPlayer . " dime la segunda posición en la quiere colocar su ficha (" . $player . ")");

        if(!comprobePos($gameBoard, $playerMov1, $playerMov2)) {
            echo "Jugador" . $numberPlayer . " esa posición no es válida\n";
        } else {
            $stop = true;
        }
    }
    return [$playerMov1, $playerMov2];
}

function comprobeFinish($gameBoard)
{
    $finish = false;
}

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

function movePlayer($gameBoard, $mov)
{
    $stop = false;
    $player = $mov % 2 === 0 ? "X" : "O";
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
    return [$playerMov1, $playerMov2, $player];
}

function comprobeFinish($gameBoard, $mov)
{
    $finish = 3;

    if($mov === 9) {
        return 0;
    }

    for($pos = 0; $pos < 3; $pos++) {

        if(count(array_keys($gameBoard[$pos],"X")) === 3) {
            $finish = 1;
            return $finish;
        } else if(count(array_keys($gameBoard[$pos],"O")) === 3) {
            $finish = 2;
            return $finish;
        }
            
        if($gameBoard[0][$pos] === "X" && $gameBoard[1][$pos] === "X" && $gameBoard[2][$pos] === "X"){
            $finish = 1;
            return $finish;
        } else if ($gameBoard[0][$pos] === "O" && $gameBoard[1][$pos] === "O" && $gameBoard[2][$pos] === "O"){
            $finish = 2;
            return $finish;
        }

    }

    if($gameBoard[0][0] === "X" && $gameBoard[1][1] === "X" && $gameBoard[2][2] === "X"){
        $finish = 1;
        $stop = true;
    } else if ($gameBoard[0][0] === "O" && $gameBoard[1][1] === "O" && $gameBoard[2][2] === "O"){
        $finish = 2;
        $stop = true;
    }

    if($gameBoard[0][2] === "X" && $gameBoard[1][1] === "X" && $gameBoard[2][0] === "X"){
            $finish = 1;
            $stop = true;
    } else if ($gameBoard[0][2] === "O" && $gameBoard[1][1] === "O" && $gameBoard[2][0] === "O"){
            $finish = 2;
            $stop = true;
    }

    return $finish;
}

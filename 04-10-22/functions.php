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
    $finish = 3;
    $stop = false;

    for($row = 0; $row < 3; $row++) {
        if(count(array_keys($gameBoard[$row],"X")) === 3) {
            $finish = 1;
            break;
        } else if(count(array_keys($gameBoard[$row],"O")) === 3) {
            $finish = 2;
            break;
        }

        if($stop) {
            break;
        }

        for($column = 0; $column < 3; $column++) {
            if(isset($gameBoard[$row + 1][$column]) && isset($gameBoard[$row + 2][$column])) {
                if($gameBoard[$row][$column] === "X" && $gameBoard[$row + 1][$column] === "X" && $gameBoard[$row + 2][$column] === "X"){
                    $finish = 1;
                    $stop = true;
                    break;
                } else if ($gameBoard[$row][$column] === "O" && $gameBoard[$row + 1][$column] === "O" && $gameBoard[$row + 2][$column] === "O"){
                    $finish = 2;
                    $stop = true;
                    break;
                }
            }

            if(isset($gameBoard[$row + 1][$column + 1]) && isset($gameBoard[$row + 2][$column + 2])) {

                if($gameBoard[$row][$column] === "X" && $gameBoard[$row + 1][$column + 1] === "X" && $gameBoard[$row + 2][$column + 2] === "X"){
                    $finish = 1;
                    $stop = true;
                    break;
                } else if ($gameBoard[$row][$column] === "O" && $gameBoard[$row + 1][$column + 1] === "O" && $gameBoard[$row + 2][$column + 2] === "O"){
                    $finish = 2;
                    $stop = true;
                    break;
                }
            }

            if($column === 2 && isset($gameBoard[$row + 1 ][1]) && isset($gameBoard[$row + 2][0])) {

                if($gameBoard[$row][$column] === "X" && $gameBoard[$row + 1][$column - 1] === "X" && $gameBoard[$row + 2][$column - 2] === "X"){
                    $finish = 1;
                    $stop = true;
                    break;
                } else if ($gameBoard[$row][$column] === "O" && $gameBoard[$row + 1][$column - 1] === "O" && $gameBoard[$row + 2][$column - 2] === "O"){
                    $finish = 2;
                    $stop = true;
                    break;
                }
            }

        }
    }

    $finish = $finish !== 0 ? $finish : 0;

    return $finish;
}

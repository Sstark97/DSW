<?php

    function showMatrix ($matrix) {
        $size = count($matrix);

        for ($row = 0; $row < $size; $row++) {
            echo "[" . implode(" ", $matrix[$row]) . "]\n";
        }
    }

    function comprobeSize ($matrix1, $matrix2) {
       return count($matrix1) === count($matrix2);
    }

    function createMatrix ($columns) {
        $size = readline("De que tamaño serán las matrices ( size x size)");
        $matrix = [];
        $isColumns = $columns ? readline("Cuantás columnas quieres ?") : null;
        $size2 = $isColumns !== null ? $isColumns : $size; 

        for($i = 0; $i < $size; $i++) {
            for($j = 0; $j < $size2; $j++) {
                $elem = readline("Digame el elemento" . " [". $i . "]".  "[". $j . "]: ");
                $matrix[$i][$j] = $elem;
            }
        }

        return $matrix;
    }

    function matrixSum ($matrix1, $matrix2) {
        if(!comprobeSize($matrix1, $matrix2)) {
            return "Las matrices no tienen la misma longitud\n\n";
        }

        $size = count($matrix1);
        $matrix = [];
        $result = [];
        $sum = 0;

        for($i = 0; $i < $size; $i++) {
            for($j = 0; $j < $size; $j++) {
                $sum += $matrix1[$i][$j] + $matrix2[$i][$j];
                array_push($result, $sum);
                $sum = 0;
            }
            array_push($matrix, $result);
            $result = [];
        }

        return $matrix;

    }

    function matrixMinus ($matrix1, $matrix2) {
        if(!comprobeSize($matrix1, $matrix2)) {
            return "Las matrices no tienen la misma longitud\n\n";
        }

        $matrix = [];
        $result = [];
        $minus = 0;
        $size = count($matrix1);

        for($i = 0; $i < $size; $i++) {
            for($j = 0; $j < $size; $j++) {
                $minus += $matrix1[$i][$j] - $matrix2[$i][$j];
                array_push($result, $minus);
                $minus = 0;
            }
            array_push($matrix, $result);
            $result = [];
        }

        return $matrix;
    }

    function matrixProduct ($matrix1, $matrix2) {
        $size = count($matrix1);
        $size2 = count($matrix2[0]);

        echo $size2;

        if($size !== $size2) {
            return "El número de columnas de la Matriz 2 debe ser igual que el número de filas de la Matriz1\n";
        }

        $matrix = [];
        $result = [];
        $sum = 0;

        for($i = 0; $i < $size; $i++) {
            for($j = 0; $j < $size2 ; $j++) {
                $col = array_column($matrix2,$j);
                $multiply = array_map (function ($x, $y) { return $y * $x;},$matrix1[$i], $col);
                $sum = array_sum($multiply);

                array_push($result, $sum);
            }
            // print_r(implode(", ",$result));
            array_push($matrix, $result);
            $result = [];
        }

        return $matrix;
    }

?>
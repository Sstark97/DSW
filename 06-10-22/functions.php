<?php

    function showMatrix ($matrix) {
        $size = count($matrix);

        for ($row = 0; $row < $size; $row++) {
            echo "[" . implode(" ", $matrix[$row]) . "]\n";
        }
    }

    function createMatrix () {
        $size = readline("De que tamaño serán las matrices ( size x size)");
        $matrix = [];

        for($i = 0; $i < $size; $i++) {
            for($j = 0; $j < $size; $j++) {
                $elem = readline("Digame el elemento " . $i . $j);
                $matrix[$i][$j] = $elem;
            }
        }

        return $matrix;
    }

    function matrixSum ($matrix1, $matrix2) {
        $size1 = count($matrix1);
        $size2 = count($matrix2);
        if($size1 !== $size2) {
            return "Las matrices no tienen la misma longitud";
        }

        $matrix = [];
        $result = [];
        $sum = 0;

        for($i = 0; $i < $size1; $i++) {
            for($j = 0; $j < $size1; $j++) {
                $sum += $matrix1[$i][$j] + $matrix2[$i][$j];
                array_push($result, $sum);
            }
            array_push($matrix, $result);
            $result = [];
        }

        return $matrix;

    }

    function matrixMinus ($matrix1, $matrix2) {
        $size1 = count($matrix1);
        $size2 = count($matrix2);
        if($size1 !== $size2) {
            return "Las matrices no tienen la misma longitud";
        }

        $matrix = [];
        $result = [];
        $minus = 0;

        for($i = 0; $i < $size1; $i++) {
            for($j = 0; $j < $size1; $j++) {
                $minus += $matrix1[$i][$j] - $matrix2[$i][$j];
                array_push($result, $minus);
            }
            array_push($matrix, $result);
            $result = [];
        }

        return $matrix;
    }

    function matrixProduct ($matrix1, $matrix2) {
        $size1 = count($matrix1);
        $size2 = count($matrix2);
        if($size1 !== $size2) {
            return "Las matrices no tienen la misma longitud";
        }

        $matrix = [];
        $result = [];
        $minus = 0;

        for($i = 0; $i < $size1; $i++) {
            for($j = 0; $j < $size1; $j++) {
                $minus += $matrix1[$i][$j] - $matrix2[$i][$j];
                array_push($result, $minus);
            }
            array_push($matrix, $result);
            $result = [];
        }

        return $matrix;
    }
?>
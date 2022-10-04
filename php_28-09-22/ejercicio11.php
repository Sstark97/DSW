<?php

    /*
        Dado un array de números, un número es “líder” si su valor es mayor que la suma de
        todos los números que se encuentran a su derecha. Escribir un programa que dado un
        array de números, devuelva otro array conteniendo los números líderes.
        Ejemplos:
        • leaders ([1, 2, 3, 4, 0]) ==> return [4]
        • leaders ([16, 17, 4, 3, 5, 2]) ==> return {17, 5, 2]
        • leaders ([5, 2, -1]) ==> return [5, 2]
        • leaders ([0, -1, -29, 3, 2]) ==> return [0, -1, 3, 2]

    */

    $array = [1, 2, 3, 4, 0];
    $res = [];
    define("size",count($array));

    for($i = 0; $i <= size - 1; $i++) {
        $subarray = array_slice($array, $i + 1);
        $value_sum = array_sum($subarray);

        if ($array[$i] > $value_sum || $i == size - 1) {
            array_push($res, $array[$i]);
        }
    }

    echo "[" . implode(", ", $res) . "]";
?>
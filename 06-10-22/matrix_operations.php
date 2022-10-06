<?php
    /*
        Realizar un programa en PHP que, mostrando un menú, el usuario seleccione una de las siguientes
        operaciones: suma, resta o producto de dos matrices, introducidas por el usuario, y muestre el
        resultado
    */

    include "functions.php";

    $mockM1 = [[2,0,1],[3,0,0], [5,1,1]];
    $mockM2 = [[1,0,1],[1,2,1], [1,1,0]];
    $mockSum = matrixProduct($mockM1, $mockM2);
    $col = array_column($mockM1,1);

    $multiply = array_map (function ($x, $y) {
        return $y * $x;
    },$mockM1[0], $col);

    showMatrix($mockSum);

    // $menu = [
    //     1 => matrixSum(), 
    //     2 => matrixMinus(), 
    //     3 => matrixProduct()
    // ];

    // $matrix = createMatrix();
    
    // showMatrix($matrix);

?>
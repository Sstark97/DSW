<?php
    /*
        Realizar un programa en PHP que, mostrando un menú, el usuario seleccione una de las siguientes
        operaciones: suma, resta o producto de dos matrices, introducidas por el usuario, y muestre el
        resultado
    */

    include "functions.php";

    $mockM1 = [[1,2,4],[1,2,6], [1,2,6]];
    $mockM2 = [[2,3,1],[4,2,6], [1,2,6]];
    $mockSum = matrixMinus($mockM1, $mockM2);

    showMatrix($mockSum);

    // $menu = [
    //     1 => matrixSum(), 
    //     2 => matrixMinus(), 
    //     3 => matrixProduct()
    // ];

    // $matrix = createMatrix();
    
    // showMatrix($matrix);

?>
<?php
    /*
        Realizar un programa en PHP que, mostrando un menú, el usuario seleccione una de las siguientes
        operaciones: suma, resta o producto de dos matrices, introducidas por el usuario, y muestre el
        resultado
    */

    include "functions.php";
    $stop = false;

    while(!$stop) {
        echo "Operaciones con matrices: \n1) Suma\n2) Resta\n3) Producto\n4) Salir\n";
        $option = readline("");

        switch ($option) {
            case 1: 
                $matrix1 = createMatrix(false);
                $matrix2 = createMatrix(false);
                
                $resultSum = matrixSum($matrix1, $matrix2);
                echo !is_string($resultSum) ? "El resultado es: \n" . showMatrix($resultSum) : $resultSum;
                break;
            case 2: 
                $matrix1 = createMatrix(false);
                $matrix2 = createMatrix(false);
                
                $resultMinus = matrixMinus($matrix1, $matrix2);
                echo !is_string($resultMinus) ? "El resultado es: \n" . showMatrix($resultMinus) : $resultMinus;
                break;
            case 3: 
                $matrix1 = createMatrix(false);
                $matrix2 = createMatrix(true);
                
                $resultProduct = matrixProduct($matrix1, $matrix2);
                echo !is_string($resultProduct) ? "El resultado es: \n" . showMatrix($resultProduct) : $resultProduct;
                break;
            case 4:
                $stop = true;
                break;
            default: 
                echo "La opción no es válida";
        }
    }

?>
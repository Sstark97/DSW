<?php

    // Crea un array de 5 números aleatorios entre 20 y 30, y muestralo

    $random_array = [];
    $array_string = "[";

    for ($i = 0; $i < 5; $i++) {
        $random_array[$i] = rand(20,30);
        $array_string .= $random_array[$i];
        $array_string .= $i != 4 ? "," : ""; 
    }

    $array_string .= "]";
    echo $array_string;
    
?>
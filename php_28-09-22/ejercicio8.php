<?php

    // Crea un array de 5 números aleatorios entre 20 y 30, y muestralo

    $random_array = [];

    for ($i = 0; $i < 5; $i++) {
        $random_array[$i] = rand(20,30);
    }

    echo implode(",", $random_array);
    
?>
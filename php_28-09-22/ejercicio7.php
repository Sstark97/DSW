<?php
    /*
        Crea y muestra un array con los números pares entre 1 y 100.
    */
    $even_array = [];
    $pointer = 0;
    $array_string = "[";

    for ($i = 0; $i <= 100; $i ++) {
        if ($i % 2 == 0){
            $even_array[$pointer] = $i;
            $array_string .= $even_array[$pointer] . ",";
        }
        $pointer++;
    }

    $array_string .= "]";

    echo$array_string;
    

?>
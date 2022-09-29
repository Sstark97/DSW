<?php
    /*
        Recibes una string de valores separados por coma. Debes eliminar del string los valores
        duplicados, mostrando el valor inicial y el valor tras eliminar los duplicados. Por
        ejemplo, para la siguiente cadena “1,2,3,2,4,1,5" se mostrará:
        1,2,3,2,4,1,5
        1,2,3,4,5
    */

    $string = "1,2,3,2,4,1,5";
    $string_array = explode(",", $string);
    $array_unique = array_unique($string_array);

    echo $string . "\n";
    echo implode(",", $array_unique);

?>
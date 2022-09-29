<?php

    /*
        El saltamonte.
        Desarrollar un programa que recibe una cadena de valores enteros separados por coma
        que representa los “saltos". El mismo deberá mostrar el número en la posición actual y
        a continuación saltar tantas posiciones como el número indicado, mostrando en esas
        posiciones _ (underscore) y volviendo a empezar. En el caso de mostrar un 0, se finaliza.
        Por ejemplo, saltos=2,3,4,1,5,3,6,7,8,1,10,0,20 se mostraría:
        2,_,_,1,_,3,_,_,_,1,_,0,
    */

    $jumps = readline("Introduce la cadena de saltos separados por comas: ");
    $jums_array = explode(",",$jumps);
    $res = "";
    $i = 0;
    define("size",count($jums_array));

    while ($i < size - 1) {
        $element = $jums_array[$i];
        if ($element == 0) {
            $res .= $element . ",";
            break;
        }

        $res .= $element . str_repeat("_,", $element);
        $i += (int)$element + 1;
    }

    echo $res;
?>
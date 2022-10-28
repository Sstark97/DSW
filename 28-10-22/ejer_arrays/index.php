<?php
    $a=array(1,2,3,1,1,2,3,3,4,4,4,0,1);

    $b=array("blanco","azul","blanco","blanco","azul","Blanco","Azul");

    $c=array(
    
    "b" =>"verde",
    
    "c" =>"rojo",
    
    "e" =>"verde",
    
    "f" =>"Rojo",
    
    "g" =>"Verde",
    
    "a"=>"rojo",
    
    "d" =>"rojo");
    
    $C=array(
    
    "b" =>"verde",
    
    "c" =>"rojo",
    
    "e" =>"verde",
    
    "f" =>"Rojo",
    
    "g" =>"Verde",
    
    "a"=>"rojo",
    
    "d" =>"rojo");

    // 1. Mediante el uso de la función “range”, crea una matriz de números enteros comprendidos entre 7 y 11, 
    // almacena la misma en una variable denominada $r y muestra el valor tanto de la clave como del elemento almacenado.

    $r = [range(7,11)];
    // print_r($r);

    /**
     * 2. Muestra el contenido del array $r. Ahora aplica sobre la misma la función “shuffle”. Muestra el par clave – valor. ¿Qué realiza esta función?
     */
    shuffle($r);
    // print_r($r);

    /**
     * 3. Mediante el uso de la función “array_flip” intercambia los valores y las claves. 
     * Se realizará sobre $a y el resultado se guardará en $p y sobre $c y el resultado se almacenará en $q. 
     * Muestra el par clave – valor tanto de $p como de $q. ¿Qué tipo de intercambio realiza la misma?
     */
    $p = array_flip($a);
    $q = array_flip($c);
    // print_r($p);
    // print_r($q);

    /*
        4. Mediante el uso de la función “array_unshift” inserta los siguientes elementos 97, 
        “Pepe” y 128. Muestra el par clave-valor del resultado de la inserción. ¿Por dónde se realizó la misma?
        Realiza la misma inserción pero ahora en el array $c y muestra el resultado.
    */

    array_unshift($a, 97, "Pepe", 128);
    // print_r($a);
    array_unshift($c, 97, "Pepe", 128);
    // print_r($c);

    /*
        5. Mediante el uso de la función “array_push” inserta los siguientes elementos 3.4, ”Luis” y 69 en el array $a. 
        Muestra el par clave-valor del resultado de la inserción. ¿Por dónde se realizó la inserción? Realiza la misma inserción en $c.
    */

    array_push($a, 3.4, "Luis", 69);
    // print_r($a);
    array_push($c, 3.4, "Luis", 69);
    // print_r($c);

    /*
        6. Dado el siguiente código, ¿qué realiza la función array_pad?

        <?php

        $wz1=array_pad($a,25,"relleno");

        foreach($wz1 as $clave=>$valor){

        echo "Clave: ",$clave," Valor: ",$valor,"<br>";

        ?>
    */

    // Rellenando las posiciones vacias con la string "relleno"

    /*
        7. Vamos a utilizar la misma función del punto 6, pero ahora el array que se le pasa por parámetro es $c, 
        el segundo valor es -17 y el tercero es “relleno”. El resultado se almacena en $wz2. Muestra el resultado clave-valor. ¿Qué ha ocurrido ahora?
    */

    $wz = array_pad($c,-17,"relleno");
    // print_r($wz);
    
    // Pone "relleno" por el principio

    /*
        8. Utiliza las función “array_merge” con dos parámetros $a y $b y almacena el resultado en $wz3. Muestra el resultado clave-valor. ¿Qué realiza esta función?
    */

    $wz3 = array_merge($a,$b);
    // print_r($wz3);

    // Fusiona los arrays

    /*
        9. Utiliza la función “array_shift” pasándole como parámetro $a y almacenando su contenido en $stack. 
        Muestra el contenido clave-valor de $a así como el valor de $stack. ¿Qué crees que realiza la función?
    */

    $stack = array_shift($a);
    // print_r($a);
    // print $stack;

    /*
        10. Utiliza la función “array_pop” pasándole como parámetro $a y almacenando su contenido en $stack. 
        Muestra el contenido clave-valor de $a así como el valor de $stack. ¿Qué crees que realiza la función?
    */

    $stack = array_pop($a);
    // print_r($a);
    // print $stack;

    // Elimina por el final

    /*
        11. Asígnale a la variable $zz1 el resultado de ejecutar la función array_slice 
        que tiene dos parámetros, $a y como segundo parámetro 3. Muestra el resultado clave-valor de $zz1 e indica qué realiza esta función.
    */

    $zz1 = array_slice($a,3);
    // print_r($a);
    // print_r($zz1);

    // devuelve un sub_array de a desde la pos 3

    /*
        12. Utilizando la misma función que en el punto 11, teniendo como segundo parámetro un -3 y 
        almacenando el resultado en $zz2, muestra el resultado clave-valor e indica qué realiza en este caso la función
    */

    $zz2 = array_slice($a,-3);
    // print_r($a);
    // print_r($zz2);

    // Hace lo mmismo en sentido inverso

    /*
        13. Utilizando la misma función del punto 11, ahora pasas como parámetro $b, como segundo parámetro 3 
        y como tercer parámetro un 4, y almacenas el resultado en $zz3. Muestra el contenido de $zz3. ¿Qué es lo que ha hecho ahora la función?
    */

    $zz3 = array_slice($b,3,4);
    // print_r($zz3);

    // Coge los elementos de la posición 3 a la 4

    /*
    14. Utilizando la misma función del punto 11, y almacenando el resultado en $zz4, y pasando como parámetros $b, 3 y -2, 
    muestra el resultado e indica que ha ocurrido en este caso
    */

    $zz4 = array_slice($b,3,-2);
    // print_r($zz4);

    // Mostro el primer elemetno de b

    /*
    15. Utilizando la misma función del punto 11, y almacenando el resultado en $zz5, y pasando como parámetros $b, -5 y -2, muestra el resultado e indica que ha ocurrido en este caso.
    */

    $zz5 = array_slice($b,-5,-2);
    print_r($zz5);

    // Devuelde los dos primeros elementos

    /*
        16. Pasando como parámetro $c a la función “array_reverse”, almacena su resultado en $inv, muestra el resultado clave-valor e indica qué realiza la misma.
    */

    $inv = array_reverse($c);
    // print_r($inv);

    // Invierte el array
?>
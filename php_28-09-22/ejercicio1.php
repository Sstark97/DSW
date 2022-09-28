<?php
    // Declaración de variables 
    $number = 1;
    $decimal = 1.2;
    $list = [1,2,4];
    $string = "Hola $number";
    $string2 = 'Hola 2';
    $boolean = true;
    $dic = Array(
        "pos1" => "Hola",
        "pos2" => "Hola 2"
    );

    // Concatenar cadenas
    $concat1 = $string . $string2 . "\n";
    $concat2 = $string2 . $string . "\n";

    echo "Concatenar cadenas \n";
    echo $concat1;
    echo $concat2;
    echo "\n";

    // Salida por consola 
    echo "Salida por Consola \n";
    echo $concat1;
    print $concat2;
    echo "\n";

    // Declaración de constantes
    define("PI", 3.1416);
    const E = 2.71828;

    echo "Declaración de constantes \n";
    echo PI;
    echo "\n";
    echo E;
    echo "\n";

    // var_dump() ==> typeof js
    echo "var_dump()\n";
    var_dump(PI);
    var_dump($concat1);
    echo "\n";

    // converción explícita de tipos
    $string_number = (string)($number + $decimal);
    $boolean_cast = (boolean)($number);

    echo "converción explícita de tipos\n";
    var_dump($string_number);
    var_dump($boolean_cast);
    echo "\n";

    // Referencias
    $string_pointer = &$string;
    $boolean_pointer = &$boolean_cast;

    echo "Referencias \n";
    echo $string_pointer;
    echo $boolean_pointer;
    
?>
<?php

// Crea un array llamado nombres que contenga varios nombres
$array = ["Sara", "Aitor", "Juan", "Mario", "Leticia", "Laura"];

// Muestra el número de elementos que tiene el array (función count)
echo "Número de elementos: " . count($array) . "<br><br>";

// Crea una cadena que contenga los nombres de los alumnos existentes en el array separados por un espacio y muéstrala (función de strings implode)

$chain = implode(" ", $array);
echo "Resultado de implode: " . $chain . "<br><br>";

// Muestra el array ordenado alfabéticamente (función asort).
asort($array);
echo "Resultado de orden alfabético: " . implode(" ", $array) . "<br><br>";

// Muestra por pantalla las diferencias con ksort y con sort.
ksort($array);
echo "Resultado de ksort: " . implode(" ", $array) . " (Descendente)<br><br>";
sort($array);
echo "Resultado de sort: " . implode(" ", $array) . " (Ascendente)<br><br>";

// Muestra el array en el orden inverso al que se creó (función array_reverse)
$reversed = array_reverse($array);
echo "Resultado del array inverso: " . implode(" ", $reversed) . "<br><br>";

// Muestra la posición que tiene tu nombre en el array (función array_search)
$pos = array_search("Aitor", $array);
echo "Posición de mi nombre: " . $pos . "<br><br>";

// Crea un array de alumnos donde cada elemento sea otro array que contenga el id, nombre y edad del alumno.
$students = array(
    array(
        "id" => "Al01",
        "name" => "Sara",
        "age" => 22
    ),
    array(
        "id" => "Al02",
        "name" => "Aitor",
        "age" => 25
    ),    
    array(
        "id" => "Al03",
        "name" => "Juan",
        "age" => 23
    ),
    array(
        "id" => "Al04",
        "name" => "Mario",
        "age" => 22
    ),
    array(
        "id" => "Al05",
        "name" => "Leticia",
        "age" => 25
    ),
    array(
        "id" => "Al06",
        "name" => "Laura",
        "age" => 28
    )
);

// Crea una tabla html en la que se muestren todos los datos de los alumnos.
echo "Tabla con los datos de los students<br>";
echo "<table style='width: 520px' >
        <thead>
            <tr>
                <td>Id</td>
                <td>Nombre</td>
                <td>Edad</td>
            </tr>
        </thead>
        <tbody>
    ";
foreach ($students as $student){
    echo "<tr><td>" . $student['id'] ."</td>";
    echo "<td>" . $student['name'] ."</td>";
    echo "<td>" . $student['age'] ."</td></tr>";
}
echo "</tbody></table>";

// Utiliza la función array_column para obtener un array indexado que contenga únicamente los nombres de los alumnos y muéstralo por pantalla.
$names = array_column($students, 'name');
$names = implode("<br>", $names);
echo "<br>Nombre de los alumnos:<br>" . $names . "<br><br>";

// Crea un array con 10 números y utiliza la función array_sum para obtener la suma de los 10 números.
$numbers = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
echo "Suma de los elementos: " . array_sum($numbers);

?>
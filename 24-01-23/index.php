<?php
    require_once "Employee.php";
    require_once "ComplexNumber.php";

    $employee = new Employee("Pepe", 3500);

    $employee2 = new Employee("Juan", 2300);

    $employee = clone $employee2;
    $employee->setName("Paco");

    $firts = $employee == $employee2 ? "Son iguales" : "No son iguales";
    $second = $employee === $employee2 ? "Son iguales" : "No son iguales";

    $complex = new ComplexNumber(4, 3);
    $complex2 = new ComplexNumber(5, -6);
    $complex3 = $complex->sum($complex2);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empleado</title>
</head>
<body>
    <?= $firts ?>
    <br>
    <?= $second ?>
    <br>
    <p><?= $complex->show() ?> suma <?= $complex2->show() ?> </p>
    <?php  ?>
    <p>Suma de complejos: <?= $complex3->show()?></p>
</body>
</html>
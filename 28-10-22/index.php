<?php
    require_once "functions.php";
?>

<!DOCTYPE html>
<html lang="es">
<?php
    createHead("Fibonacci")
?>
<body>
    <?php
        $pos = mt_rand(0,30);

        echo "<h1> Fibo de la posición $pos:  " . fibo($pos) ."</h1>";
    ?>
</body>
</html>
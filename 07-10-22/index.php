<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
    <title>Aitor</title>
</head>
<body>
    <h1>Aitor Santana Cabrera</h1>
    <p>ASCII Art:</p>
    <pre>    
             *
            ***
           ** **
          **   **
         *********
        **       **
       **         **
    </pre>
    <?php
        echo 'The SHA256 hash of ""Aitor Santana" is:' . hash('SHA256', 'Aitor');
    ?>
    <p><a href="./check.php">Click here to check the error setting</a></p>
    <p><a href="./fail.php">Click here to cause a traceback</a></p>
    <?php
        error_reporting(0);
    ?>
</body>
</html>
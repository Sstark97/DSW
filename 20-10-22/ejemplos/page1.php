<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page 1</title>
</head>
<body>
    <?php
        echo $_POST['name'] . " " . $_POST['surname'] . "\n";
        echo $_POST['direction'] . "\n";
        echo $_POST['phone'];
    ?>
</body>
</html>
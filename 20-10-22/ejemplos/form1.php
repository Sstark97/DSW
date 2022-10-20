<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Using Forms (POST)</title>
</head>
<body>

    <form method="post" action="page1.php">
        <div>
        <label for="name">Name</label>
                <input type="text" name="name" id="name">
        </div>
        <div>        
            <label for="surname">Surname</label>
            <input type="text" name="surname" id="surname">
        </div>
        <div>
            <label for="direction">Direction</label>
            <input type="text" name="direction" id="direction">
        </div>
        <div>
            <label for="phone">Phone</label>
            <input type="text" name="phone" id="phone" maxlength="9" pattern="[0-9]{9}">
        </div>
        <button type="submit">Submit</button>
    </form>

</body>
</html>

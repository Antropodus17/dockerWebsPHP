<?php

declare(strict_types=1);



if ($_POST["confirmacion"]) {
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log Out</title>
</head>

<body>
    <form action=<?php $_SERVER["PHP_SELF"] ?> method="post">
        <label for="confirm">Do you really want to sign out?</label>
        <input type="radio" name="yes" id="rYes">Yes</input>
        <input type="radio" name="no" id="rNo">No</input>
        <input type="submit" value="confirmar">
    </form>
</body>

</html>
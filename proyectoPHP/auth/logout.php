<?php

declare(strict_types=1);
session_start();


if (isset($_POST["confirm"])) {
    if ($_POST["confirm"] == "yes") {
        session_unset();
        session_destroy();
    }
    header("Location: ../../proyectoPHP");
    exit();
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
    <?php echo $_SESSION["user"]; ?>
    <form action=<?php echo $_SERVER["PHP_SELF"] ?> method="post">
        <label for="confirm">Do you really want to sign out?</label>
        <input type="radio" name="confirm" id="rYes" value="yes">Yes</input>
        <input type="radio" name="confirm" id="rNo" value="no">No</input>
        <input type="submit" value="confirmar">
    </form>
</body>

</html>
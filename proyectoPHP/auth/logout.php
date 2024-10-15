<?php

declare(strict_types=1);

//IMPORTS
require_once("../utils/pageBasics.php");

session_start();


if (isset($_POST["confirm"])) {
    if ($_POST["confirm"] == "yes") {
        session_unset();
        session_destroy();
    }
    header("Location: /proyectoPHP/");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log Out</title>
    <?php PageBasics::basicCss() ?>
    <link rel="stylesheet" href="../styles/logout.css">
</head>

<body>
    <?php
    $header = new PageBasics();
    $header->createHeader();
    ?>
    <form action=<?php echo $_SERVER["PHP_SELF"] ?> method="post">
        <label for="confirm">Do you really want to sign out?</label>
        <label for="confirm2">Yes<input type="radio" name="confirm" id="rYes" value="yes"></input></label>
        <label for="confirm3">No<input type="radio" name="confirm" id="rNo" value="no"></input></label>
        <input type="submit" value="confirmar">
    </form>

    <?php
    $footer = new PageBasics();
    $footer->createFooter();
    ?>
</body>

</html>
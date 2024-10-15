<?php

declare(strict_types=1);

//IMPORTS
require_once("../utils/pageBasics.php");

session_start();
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $validate = true;
    $pageBasics = new PageBasics();
    try {
        $m = "validando";
        $pageBasics->validador->validateUserLogin($_POST["user"]);
        $pageBasics->validador->validatePasswordLogin($_POST["user"], $_POST["paswd"]);

        $pageBasics->loginSucces();
    } catch (Exception $e) {
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php PageBasics::basicCss(); ?>
    <link rel="stylesheet" href="../styles/login.css">
</head>

<body>
    <?php
    PageBasics::createHeader();
    ?>
    <main>
        <?php
        $pageBasics = new PageBasics();
        $pageBasics->createLogin();
        ?>
    </main>
    <?php
    PageBasics::createFooter();
    ?>
</body>

</html>
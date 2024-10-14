<?php

declare(strict_types=1);

//IMPORTS
require_once("../utils/pageBasics.php");

session_start();
if (!isset($_SESSION["user"])) { //COMPROBATE IF SESSION IS STARTED
    setcookie("noUser", $_SERVER["PHP_SELF"], time() + 60 * 60, "/");
    header("Location: /proyectoPHP/auth/login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Energy Calculator</title>
    <?php PageBasics::basicCss() ?>
    <link rel="stylesheet" href="../styles/generatorForm.css">

</head>

<body>
    <?php $pageBasics = new PageBasics();
    $pageBasics->createHeader(); ?>
    <main>
        <h1>Energy Calculator</h1>
        <?php
        $pageBasics = new PageBasics();
        $pageBasics->createGeneratorForm();

        ?>
    </main>
    <?php
    $pageBasics = new PageBasics();
    $pageBasics->createFooter();
    ?>
</body>

</html>
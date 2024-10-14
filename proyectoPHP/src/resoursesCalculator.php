<?php

declare(strict_types=1);

//IMPORTS
require_once("../utils/pageBasics.php");
require_once("../utils/validador.php");

session_start();
if (!isset($_SESSION["user"])) { //COMPROBATE IF SESSION IS STARTED
    setcookie("noUser", $_SERVER["PHP_SELF"], time() + 60 * 60, "/");
    header("Location: /proyectoPHP/auth/login.php");
    exit;
}

function validateUds($cantidad): bool {
    return is_int($cantidad) && $cantidad > 0;
}


function validateIndex($resource): bool {
    $resource = Validador::clean($resource);
    return is_string($resource);
}


function validateResourceForm(): bool {
    return validateIndex($_POST["resource"]) && validateUds($_POST["cantidad"]);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Energy Calculator</title>
    <?php PageBasics::basicCss(); ?>
</head>

<body>
    <?php $header = new PageBasics();
    $header->createHeader(); ?>
    <main>
        <?php
        $pageBasic = new PageBasics();
        $pageBasic->createResourcesForm();
        ?>
    </main>
    <?php $footer = new PageBasics();
    $footer->createFooter(); ?>
</body>

</html>
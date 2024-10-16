<?php

declare(strict_types=1);

//IMPORTS
require_once("../utils/pageBasics.php");
require_once("../utils/validador.php");
require_once("../utils/Calculator.php");

session_start();
if (!isset($_SESSION["user"])) { //COMPROBATE IF SESSION IS STARTED
    setcookie("noUser", $_SERVER["PHP_SELF"], time() + 60 * 60, "/");
    header("Location: /proyectoPHP/auth/login.php");
    exit();
}

/**
 * Validate the amount of resources and if it is a positive integer
 * @param string $cantidad the amount of resources
 * @return bool if the amount is a positive integer
 * @package proyectoPHP/src
 * @author A23SergioPN
 */
function validateUds(string $cantidad): bool {

    return is_int(intval($cantidad)) && intval($cantidad) > 0;
}

/**
 * Validate the index of the resource
 * @param string $resource the index of the resource
 * @return string the index of the resource cleaned
 * @package proyectoPHP/src
 * @author A23SergioPN
 */
function validateIndex($resource): string {
    $resource = Validador::clean($resource);
    return $resource;
}

/**
 * Validate the form of the resources
 * @return bool if the form is valid
 * @package proyectoPHP/src
 * @author A23SergioPN
 */
function validateResourceForm(): bool {
    return is_string(validateIndex($_POST["resource0"])) && validateUds($_POST["cantidad0"]);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Energy Calculator</title>
    <?php PageBasics::basicCss(); ?>
    <link rel="stylesheet" href="../styles/resourcesForm.css?">
</head>

<body>
    <?php $header = new PageBasics();
    $header->createHeader(); ?>
    <main>
        <?php
        $pageBasic = new PageBasics();
        $pageBasic->createResourcesForm();
        if ($_SERVER["REQUEST_METHOD"] === "POST" && validateResourceForm()) {
            $calculator = new Calculator();
            $calculator->calculateResources(validateIndex($_POST["resource0"]), intval($_POST["cantidad0"]));
        } else if ($_SERVER["REQUEST_METHOD"] === "POST") {
            echo "Datos no válidos";
        }
        ?>
    </main>
    <?php $footer = new PageBasics();
    $footer->createFooter(); ?>
</body>

</html>
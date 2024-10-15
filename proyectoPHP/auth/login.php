<?php

declare(strict_types=1);

session_start();

//IMPORTS
require_once("../utils/validador.php");
require_once("../utils/errors/UserException.php");
require_once("../utils/errors/PasswordException.php");
require_once("../utils/pageBasics.php");

//VARIABLES
global $errorMessage;
$errorMessage = [];

global $estado;
$estado = 'ben';

//SIMULATION OF DATABASE
global $usersDatabase;
$usersDatabase = [
    "root" => "abc123.",
    "user" => "prueba"
];





//FUNCTIONS

/**
 * 
 */
function loginSucces() {
    global $validator;

    if (isset($_COOKIE["noUser"])) { //RETURN TO THE LAST PAGE
        $redirect = ""  .  $_COOKIE["noUser"];
        setcookie("noUser", "", -1);
        header("Location: $redirect");
    } else { //RETURN TO THE INDEX
        header("Location: /proyectoPHP/");
    }
    exit();
}

/**
 * 
 */
function validatePassword() {

    $usersDatabase = [
        "root" => "abc123.",
        "user" => "prueba"
    ];
    $validator = new Validador();
    if (!$validator->comprobarValorArray($usersDatabase, Validador::clean($_POST["user"]), Validador::clean($_POST["paswd"]))) {
        throw new PasswordException("Wrong password");
    }
}



/**
 * 
 */
function validateLogin() {
    $loginSucces = true;
    global $errorMessage;
    //VALIDATIONS
    try {
        validateUser();
        validatePassword();
    } catch (UserException $e) { //ERROR IN VALIDATION
        $errorMessage["user"] = $e->getMessage();
        $loginSucces = false;
    } catch (PasswordException $e) {
        $errorMessage["paswd"] = $e->getMessage();
        $loginSucces = false;
    }
    if ($loginSucces) { //VALIDATION OKEY?
        loginSucces();
    }
}

//REVISION

if (isset($_POST["login"]) && $_POST["login"] === "si") {
    global $estado;
    $estado = 'post';
    validateLogin();
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <?php PageBasics::basicCss(); ?>
    <link rel="stylesheet" href="../styles/login.css">

</head>

<body>
    <?php
    $pageBasics = new PageBasics();
    $pageBasics->createHeader();
    ?>
    <main>

    </main>
    <?php
    $pageBasics = new PageBasics();
    $pageBasics->createFooter();
    ?>
</body>

</html>
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

    $_SESSION["user"] = Validador::clean($_POST["user"]);
    $_SESSION["paswd"] = Validador::clean($_POST["paswd"]);
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

    global $usersDatabase;
    $validator = new Validador();
    if (!$validator->comprobarValorArray($usersDatabase, Validador::clean($_POST["user"]), Validador::clean($_POST["paswd"]))) {
        throw new PasswordException("Wrong password");
    }
}

/**
 * 
 */
function validateUser() {
    global $estado;
    $estado = "Validating User";

    if (null === Validador::clean($_POST["user"])) {
        throw new UserException("Wrong user");
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

</head>

<body>
    <?php
    $pageBasics = new PageBasics();
    $pageBasics->createHeader();
    ?>
    <main>
        <form action=<?php echo $_SERVER["PHP_SELF"]; ?> method="post">

            <label for="user">User: </label>
            <input type="text" name="user" id="iUser"><?php global $errorMessage;
                                                        isset($errorMessage["user"]) ? ("<p>" . $errorMessage["user"] . "</p>") : "" ?><br>
            <label for="paswd">Password: </label>
            <input type="password" name="paswd" id="iPaswd"><?php global $errorMessage;
                                                            isset($errorMessage["paswd"]) ? ("<p>" . $errorMessage["paswd"] . "</p>") : "" ?><br>
            <input type="submit" value="Iniciar Sesion">
            <input type="hidden" name="login" value="si">
            <?php
            echo $_SESSION["user"] . "<br>";
            echo $_COOKIE["noUser"] . "<br>"; ?>
        </form>
    </main>
    <?php
    $pageBasics = new PageBasics();
    $pageBasics->createFooter();
    ?>
</body>

</html>
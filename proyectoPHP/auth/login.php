<?php

declare(strict_types=1);

//IMPORTS
require_once("../utils/validador.php");

//VARIABLES
global $errorMessage;

//SIMULATION OF DATABASE
global $usersDatabase;
$usersDatabase = [
    "root" => "abc123.",
    "user" => "prueba"
];


//OBJECTS
global $validator;
$validator = new Validador();

//FUNCTIONS

/**
 * 
 */
function loginSucces()
{
    global $validator;
    session_start([
        "user" => $validator->clean($_POST["user"]),
        "password" => $validator->clean($_POST["paswd"])
    ]);
    $redirect=$_COOKIE["noUser"];
    header("Location: $redirect");
}

/**
 * 
 */
function validatePassword()
{
    global $usersDatabase;
    global $validator;
    if (!$validator->comprobarValorArray($usersDatabase, $validator->clean($_POST["user"]), $validator->clean($_POST["paswd"]))) {
        throw new Exception("Wrong password");
    }
}

/**
 * 
 */
function validateUser()
{
    global $usersDatabase;
    global $validator;
    if (!isset($validator->clean($_POST["user"]))) {
        throw new Exception("Wrong user");
    }
}

/**
 * 
 */
function validateLogin()
{
    $loginSucces = true;

    //VALIDATIONS
    try {
        validateUser();
        validatePassword();
    } catch (Exception $e) { //ERROR IN VALIDATION
        $errorMessage = $e->getMessage();
        $loginSucces = false;
    }
    if ($loginSucces) { //VALIDATION OKEY?
        loginSucces();
    }
}

//REVISION

if ($_SERVER["HTTP_REFERER"] == $_SERVER["PHP_SELF"]) {
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
</head>

<body>
    <form action=<?php echo $_SERVER["PHP_SELF"]; ?> method="post">

        <label for="user">User: </label>
        <input type="text" name="user" id="iUser"><br>
        <label for="paswd">Password</label>
        <input type="password" name="paswd" id="iPaswd"><br>
        <input type="submit" value="Iniciar Sesion">
    </form>
</body>

</html>
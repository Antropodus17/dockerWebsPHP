<?php 
declare(strict_types=1);

//IMPORTS
require_once("../utils/ayudaFormulario.php");



//OBJECTS
global $formulary;
$formulary=new AyudaFormulario();

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
<?php

declare(strict_types=1); //strict type
function factorial(int $data): int
{
    if ($data < 0) {
        throw new Exception("Number less than 0");
    } //if
    else if ($data == 1 or $data == 0) {
        return 1;
    } //else if
    else {
        return $data * factorial($data - 1);
    } //else
} // function
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Factorial con Funcion</h1>
    <form action="factorialForm.php" method="post">
        <label for="numero">Número</label>
        <input type="number" name="numero" id="numero">
        <input type="submit" value="enviar">
    </form>
    <?php
    try {
        #echo '<p> El factorial de '.$_POST["numero"].' es: '.factorial(intval($_POST["numero"]));
        echo "<p>Numero dentro del código<p>";
        define("NUM", 8);
        echo "<p>Resultado: " . factorial(NUM);
    } catch (Exception $e) {
        echo "<p>" . $e->getMessage() . "</p>";
    }
    ?>
</body>

</html>
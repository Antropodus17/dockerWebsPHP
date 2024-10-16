<?php

declare(strict_types=1);
function persona(?string $nombre, int $edad, string $apellido = "Apelido") {
    if ($edad < 0) {
        throw new Exception("La edad no puede ser negativa");
    } else {
        echo "<p><strong>" . $nombre . " " . $apellido . " is " . $edad . " years old.</strong></p>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Functions</title>
</head>

<body>
    <h1>Functions</h1>
    <form action="functions.php" method="post">
        <label for="Nombre"><strong>Nombre: </strong></label>
        <input type="text" name="Nombre" id="nombre">
        <br>
        <label for="Apellido"><strong>Apellido: </strong></label>
        <input type="text" name="Apellido" id="apelido">
        <br>
        <label for="Edad"><strong>Edad: </strong></label>
        <input type="text" name="Edad" id="edad">
        <br>
        <br>
        <input type="submit" value="Calcular">
    </form>
    <?php
    try {
        echo "<p>1ª Prueba</p>";
        persona($_POST["Nombre"], intval($_POST["Edad"]), $_POST["Apellido"]);
        echo "<p>2ª Prueba</p>";
        persona(null, intval($_POST["Edad"]));
    } catch (TypeError $e) {
        echo $e->getMessage();
    } catch (Exception $e) {
        echo $e->getMessage();
    }
    ?>
</body>

</html>
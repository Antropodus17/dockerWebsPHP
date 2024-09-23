<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Factorial</title>
</head>

<body>
    <h1>Factorial</h1>
    <form action="factorial.php" method="post">
        <label for="numero">Número</label>
        <input type="number" name="numero" id="numero">
        <input type="submit" value="enviar">
    </form>
    <?php
        $numero = $_POST['numero'];
        $total = 1;
        for (; $numero > 0; $numero--) {
            $total *= $numero;
        }
        echo "<p> El factorial de $_POST[numero]: $total</p>";
    ?>
</body>

</html>
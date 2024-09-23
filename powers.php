<?php

declare(strict_types=1);
function power(int $base, int $exp = 2): float
{
    $total = 1;
    if ($exp < 0) { //exponente negativo
        for (; $exp < 0; $exp++) {
            $total *= $base;
        }
        return 1 / $total;
    } //if
    else { //expoñente positivo
        for (; $exp > 0; $exp--) {
            $total *= $base;
        }
        return $total;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Powers</title>
</head>

<body>
    <h1>Potencias</h1>
    <form action="powers.php" method="post">
        <label for="exp"><strong>Introduzca el exponente</strong></label>
        <input type="text" name="exp" id="exp">
        <br>
        <label for="base"><strong>Introduzca la base</strong></label>
        <input type="text" name="base" id="base">
        <br>
        <br>
        <input type="submit" value="Calcular">
    </form>
    <p><em>Para probar el error del tipo de dato cambiar desde el código</em></p>
    <?php
    try {
        define("BASE","Hola");
        echo '<p>Resultado : ' . power(intval($_POST["base"])/*"BASE"*/, intval($_POST["exp"])) . '</p>';
    } catch (TypeError $e) {
        echo "Formato inválido de los datos.";
    } catch (Exception $e) {
        echo $e->getMessage();
    }
    ?>
</body>

</html>
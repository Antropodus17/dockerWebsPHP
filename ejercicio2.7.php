<?php

declare(strict_types=1);

$productos = ["cocacola" => ["text" => "Coca Cola", "precio" => 2], "pepsicola" => ["text" => "Pepsi Cola", "precio" => 2], "fantanaranja" => ["text" => "Fanta Naranja", "precio" => 2.5], "trinamanzana" => ["text" => "Trina Manzana", "precio" => 2.3]];

function createSelect(array $datos) {
    echo '<select name="opcion">';
    foreach ($datos as $key => $value) {
        echo '<option value=' . $key . '>' . $value["text"] . ' (' . $value["precio"] . ')</option>';
    }
    echo '</select>';
}

function validar() {
    foreach ($_POST as $key => $value) {
        test_input($value);
        if (empty($value)) {
            throw new Exception("Valor vacio");
        }
        if ($key == 'cantidad') {
            if (!is_numeric($value) || intval($value) < 1) {
                throw new Exception("Cantidad no válida");
            }
        }
    }
    return true;
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    $enviar = false;
    $errorMessage = 0;
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        try {
            $enviar = validar();
        } catch (Exception $e) {
            $errorMessage = $e->getMessage();
        }
    }
    if ($enviar) { ?>
        <p><strong><?php echo "You have asked for " . $_POST["cantidad"] . " bottles of " . $productos[$_POST["opcion"]]["text"] . ". Total price to pay: " . (intval($_POST["cantidad"]) * intval($productos[$_POST["opcion"]]["precio"])) . " euros" ?></strong></p>

    <?php } else {
        echo ($errorMessage == 0 ? "" : "<span style=\"color: red;\">$errorMessage</span>");
    ?>
        <form action="ejercicio2.7.php" method="post">
            <?php

            createSelect($productos)
            ?>
            <input type="number" name="cantidad" id="cantidad">uds
            <br>
            <input type="submit" value="enviar">

        </form>
    <?php } ?>
</body>

</html>
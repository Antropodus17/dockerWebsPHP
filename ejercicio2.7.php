<?php

declare(strict_types=1);

// ARRAY DE PRODUCTOS A MODO DE BASE DE DATOS.
$productos = ["cocacola" => ["text" => "Coca Cola", "precio" => 2], "pepsicola" => ["text" => "Pepsi Cola", "precio" => 2], "fantanaranja" => ["text" => "Fanta Naranja", "precio" => 2.5], "trinamanzana" => ["text" => "Trina Manzana", "precio" => 2.3]];


/**
 * funcion para la creacion del select en funcion de los productos
 * @param array $datos array de productos a colocar en el select.
 */
function createSelect(array $datos) {
    echo '<select name="opcion">';
    foreach ($datos as $key => $value) {
        echo '<option value=' . $key . '>' . $value["text"] . ' (' . $value["precio"] . ')</option>';
    }
    echo '</select>';
}

/**
 * Funcion para validar los datos del formulario
 * @return bool true si los datos son correctos.
 * @throws Exception si los datos no son correctos.
 */
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

/**
 * Funcion para limpiar los datos del formulario
 * @param string $data dato a limpiar
 * @return string dato limpio
 */
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
    // VARIABLES PARA CONTROLAR EL ENVIO DEL FORMULARIO Y LOS ERRORES
    $enviar = false;
    $errorMessage = 0;
    // REVISA SI HAY ALGUN PEDIDO PARA VALIDAR 
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        try {
            $enviar = validar();
        } catch (Exception $e) {
            $errorMessage = $e->getMessage();
        }
    }
    // SI LOS DATOS SON CORRECTOS SE MUESTRA EL MENSAJE DE CONFIRMACION 
    if ($enviar) { ?>
        <p><strong><?php echo "You have asked for " . $_POST["cantidad"] . " bottles of " . $productos[$_POST["opcion"]]["text"] . ". Total price to pay: " . (intval($_POST["cantidad"]) * floatval($productos[$_POST["opcion"]]["precio"])) . " euros" ?></strong></p>

        <!-- SI NO SE MUESTRA EL FORMULARIO CON LOS ERRORES EN CASO DE QUE LOS HAYA-->
    <?php } else {
        echo ($errorMessage == 0 ? "" : "<span style=\"color: red;\">$errorMessage</span>");
    ?>
        <!-- INICIO DEL FORMULARIO -->
        <form action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?> method="post">
            <?php

            createSelect($productos)
            ?>
            <input type="number" name="cantidad" id="cantidad" required>uds
            <br>
            <input type="submit" value="enviar">

        </form>
    <?php } ?>
</body>

</html>
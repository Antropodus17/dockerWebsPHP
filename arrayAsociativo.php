<?php

declare(strict_types=1);

function createSelect(array $datos) {
    echo '<select name="opcion">';
    foreach ($datos as $key => $value) {
        echo '<option value=' . $key . '>' . $value["text"] . ' (' . $value["precio"] . ')</option>';
    }
    echo '</select>';
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
    <form action="arrayAsociativo.php" method="post">
        <?php
        $productos = ["cocacola" => ["text" => "Coca Cola", "precio" => 2], "pepsicola" => ["text" => "Pepsi Cola", "precio" => 2], "fantanaranja" => ["text" => "Fanta Naranja", "precio" => 2.5], "trinamanzana" => ["text" => "Trina Manzana", "precio" => 2.3]];
        createSelect($productos)
        ?>

    </form>
</body>

</html>
<?php

declare(strict_types=1);
require_once("./extras/validador.php");




//FUNCIONES

/**
 * Crea el formulario de envio.
 * @param bool $enviar Indica si se debe enviar el formulario.
 * @param bool $revisar Indica si se debe revisar el formulario.
 * @return void
 */
function enviar(bool $enviar, bool $revisar) {
    if ($enviar == true && $revisar == true) {
        global $datos;
        $name = array_search($_POST['subject'], $datos);
        echo ("<form action= manage.php method='post' name='enviar' style='display: none;' enviar='$enviar'>
        <input type='hidden' name='nombre' value=" . $_POST["nombre"] . ">
        <input type='hidden' name='subjectN' value=" . $name . ">
        <input type='hidden' name='subjectV' value=" . $_POST["subject"] . ">
        <input type='submit' value='Correcto' style='display: none;'>
        </form>");
    }
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

</body>

</html>
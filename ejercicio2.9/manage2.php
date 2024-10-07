<?php

declare(strict_types=1);
require_once("./extras/validador.php");
require_once("./extras/ayudaFormulario.php");

//VARIABLES
/**
 * Array con los datos de los cursos.
 * @var array
 * @global
 */
global $datos;
$datos = ["Java Programming" => 0, "Web Design" => 1, "Dockers administration" => 2, "Django framework" => 3, "Mongo database" => 4];

/**
 * Variable que indica si se debe enviar el formulario.
 * @var bool
 * @global
 */
global $enviarFormulario;
$enviarFormulario = true;

/**
 * Variable con el objeto de ayuda al formulario.
 * @var AyudaFormulario
 * @global
 */
global $formulario;
$formulario = new AyudaFormulario();

/**
 * 
 */
global $validador;
$validador = new Validador();

/**
 * Variable que indica si se debe revisar el formulario.
 * @var bool
 * @global
 */
global $revisarFormulario;
$revisarFormulario = false;

/**
 * Variables para la muestra de errores.
 */
global $nombreValido;
$nombreValido = true;
global $subjectValido;
$subjectValido = true;
global $classesValido;
$classesValido = true;
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

/**
 * Revisa el formulario.
 */
function revisionFormulario() {
    global $validador;
    global $enviarFormulario;
    global $nombreValido;
    global $subjectValido;
    global $classesValido;
    global $datos;
    try {
        $validador->emptyInput("nombre");
    } catch (Exception $e) {
        $enviarFormulario = false;
        $nombreValido = false;
    }
    if (!($validador->existCorrectOption('subject', $datos))) {
        $enviarFormulario = false;
        $subjectValido = false;
    }
    if (!($validador->existInputRadio('classes', ['In-Person', 'Distance']))) {
        $enviarFormulario = false;
        $classesValido = false;
    }
}

//INICIACION DE CÓDIGO

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $revisarFormulario = true;
    revisionFormulario();
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
    <form action=<?php echo $_SERVER["PHP_SELF"]; ?> method="post">
        <?php
        //INICIO INPUT:TEXT
        global $nombreValido;
        global $validador;
        $formulario->createGeneralInput("nombre", "text", $_GET["nombre"]);
        echo $nombreValido ? "" : $validador->errorCampo('nombre', 'no puede estar vacio');
        //FIN INPUT:TEXT
        ?><br>
        <?php
        //INICIO SELECT
        global $datos;
        global $validador;
        $formulario->createSelect('subject', array_values($datos));
        echo $subjectValido ? "" : $validador->errorCampo('subject', 'no puede estar vacio');
        //FIN SELECT
        ?><br>
        <?php
        //INICIO INPUT:RADIO
        global $formulario;
        $formulario->createRadioCheckboxInput('classes', 'radio', ["In-Person", "Distance"]);
        echo $classesValido ? "" : $validador->errorCampo('classes', 'no puede estar vacio');
        //FIN INPUT:RADIO
        ?><br>
        <input type="submit" value="enviar">
    </form>
</body>

</html>
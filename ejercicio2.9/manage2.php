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
        $validador->emptyInput("nombre", $_GET);
    } catch (Exception $e) {
        $enviarFormulario = false;
        $nombreValido = false;
    }
    if (!($validador->existCorrectOption('subjectV', $_GET, $datos))) {
        $enviarFormulario = false;
        $subjectValido = false;
    }
    if (!($validador->existCorrectoption('classes', $_GET, ['In-Person', 'Distance']))) {
        $enviarFormulario = false;
        $classesValido = false;
    }
}

//INICIACION DE CÓDIGO



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
    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["enviar"]) && $_GET["enviar"] == "enviarCorrecion") {
        $revisarFormulario = true;
        revisionFormulario();
        if ($enviarFormulario) {
            $formulario->generateValidatePost("manage.php", ["nombre" => $_GET["nombre"], "subjectV" => $_GET["subjectV"], "subjectN" => array_search(intval($_GET["subjectV"]), $datos), "classes" => $_GET["classes"]]);
        }
    } ?>

    <form action=<?php echo $_SERVER["PHP_SELF"]; ?> method="get">
        <?php
        //INICIO INPUT:TEXT
        global $nombreValido;
        global $validador;
        $formulario->createGeneralInput("nombre", "text", $_GET["nombre"]);
        echo $nombreValido ? "" : $formulario->errorCampo('nombre', 'no puede estar vacio');
        //FIN INPUT:TEXT
        ?><br>
        <?php
        //INICIO SELECT
        global $datos;
        global $validador;
        $formulario->createSelect('subjectV', $datos, array_values($datos), $_GET["subjectV"]);
        echo $subjectValido ? "" : $formulario->errorCampo('subject', 'no puede estar vacio');
        //FIN SELECT
        ?><br>
        <?php
        //INICIO INPUT:RADIO
        global $formulario;
        $formulario->createRadioCheckboxInput('classes', 'radio', ["In-Person", "Distance"]);
        echo $classesValido ? "" : $formulario->errorCampo('classes', 'no puede estar vacio');
        //FIN INPUT:RADIO
        ?><br>
        <input type="submit" name="enviar" value="enviarCorrecion">

    </form>
    <script>
        const form = document.querySelector(".autoenvio");
        form.submit();
    </script>
</body>

>>>>>>> 3a1de27f1f96489237d1dba157a6079f79fff632
</html>
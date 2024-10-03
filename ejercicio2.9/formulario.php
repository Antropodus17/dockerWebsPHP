<?php

declare(strict_types=1);


//VARIABLES
/**
 * Array con los datos de los cursos.
 * @var array
 */
global $datos;
$datos = ["Java Programming" => 0, "Web Design" => 1, "Dockers administration" => 2, "Django framework" => 3, "Mongo database" => 4];

/**
 * Variable que indica si se debe revisar el formulario.
 * @var bool
 */
$revisarFormulario = false;

/**
 * Variable que indica si se debe enviar el formulario.
 * @var bool
 */
global $enviarFormulario;
$enviarFormulario = true;


//FUNCIONES

/**
 * Crea un select con los valores de un array.
 * @param array $array Array con los valores.
 * @param string $name nombre del select.
 * @return void
 */
function createSelect(array $array, string $name) {
    echo "<select name='$name' >";
    echo "<option disable value='' selected>Select option </option>";
    foreach ($array as $name => $value) {
        echo "<option value='$value'>$name</option>";
    }
    echo "</select>";
}

/**
 * Comprueba si un valor es igual al valor de un array en una clave determinada.
 * @param array $array Array en el que se va a buscar.
 * @param string|int $key Clave en la que se va a buscar.
 * @param mixed $value Valor que se va a comparar.
 * @return bool true si el valor es igual al valor del array en la clave determinada.
 */
function comprobarValorArray(array $array, string|int $key, mixed $value): bool {
    if (isset($array[$key]) && $array[$key] == $value) {
        return true;
    }
    global $enviarFormulario;
    $enviarFormulario = false;
    return false;
}

/**
 * Comprueba si input radio/checbox esté seleccionado.
 * @param string $campo Campo a comprobar.
 * @param string $valor Valor a comprobar.
 * @return string "checked" si el campo está seleccionado.
 */
function checkInputRadio(string $campo, string $valor): string {
    if (key_exists($campo, $_POST)) {
        if ($_POST[$campo] == $valor) {
            return "checked";
        }
    }
    return "";
}

/**
 * Cpmprueba si el input esta vacio.
 * @param string $campo Campo a comprobar.
 * @return string Valor del campo.
 * @throws Exception Si el campo está vacio.
 */
function checkEmptyInput(string $campo): string {
    if (isset($_POST[$campo]) && $_POST[$campo] != "") {
        return $_POST[$campo];
    }
    global $enviarFormulario;
    $enviarFormulario = false;
    throw new Exception("El campo $campo no puede estar vacio");
}

/**
 * Limpia los datos antes de mostrarlos en la página.
 * @param string $data Dato a limpiar.
 * @return string Dato limpio.
 */
function clean(string $data): string {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
};

/**
 * Comprueba si se escogio un option dentro del rango de valores.
 * @param string $campo nombre del select a es igual a uno de los valores de un array. comprobar.
 * @param array $valores Rango de valores válidos.
 * @return bool true si el valor es correcto y false si no.
 */
function checkCorrectOption(string $campo, array $valores) {
    if (isset($_POST[$campo])) {
        foreach ($valores as $valor) {
            if ($valor == $_POST[$campo]) {
                return true;
            }
        }
    }
    global $enviarFormulario;
    $enviarFormulario = false;
    return false;
}

/**
 * funcion intermedia para recuperar info del @see checkEmptyInput.
 * @param string $campo Campo a comprobar.
 * @return string Mensaje de error o correcto.
 * 
 */
function validar(string $campo): string {
    try {
        checkEmptyInput($campo);
    } catch (Exception $e) {
        global $enviarFormulario;
        $enviarFormulario = false;
        return $e->getMessage();
    }
    return "Correcto";
}

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
    <title>Formulario</title>
</head>

<body>
    <?php
    //CODIGO INICIAL
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $revisarFormulario = true;
    }
    ?>
    <!-- PÁXINA WEB-->
    <h1>First practice using forms</h1>
    <!-- FORMULARIO-->
    <form action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?> method="post">
        <label for="nombre">Name and surnames</label>
        <input type="text" name="nombre" id="tnombre"><?php echo $revisarFormulario ? validar("nombre") : "" ?> <br>
        <?php echo createSelect($datos, 'subject');
        echo $revisarFormulario ? (checkCorrectOption("subject", array_values($datos)) ? "" : "Elije una opcion válida") : "" ?><br>
        <input type="submit" value="Send Data">
    </form>
    <?php enviar($enviarFormulario, $revisarFormulario); ?>
    <script>
        let formulario = document.forms.namedItem('enviar');
        formulario.submit();
    </script>
</body>


</html>
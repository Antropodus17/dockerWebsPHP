<?php

declare(strict_types=1);


/**
 * Clase Validador
 */
class Validador {


    /**
     * Comprueba si un valor es igual al valor de un array en una clave determinada.
     * @access public
     * @param array $array Array en el que se va a buscar.
     * @param string|int $key Clave en la que se va a buscar.
     * @param mixed $value Valor que se va a comparar.
     * @return bool true si el valor es igual al valor del array en la clave determinada.
     */
    public function comprobarValorArray(array $array, string|int $key, mixed $value): bool {
        if (isset($array[$key]) && $array[$key] == $value) {
            return true;
        }
        return false;
    }

    /**
     * Comprueba si input radio/checbox esté seleccionado.
     * @access public
     * @param string $campo Campo a comprobar.
     * @param string $valor Valor a comprobar.
     * @return bool true si el campo está seleccionado.
     */
    public function existInputRadio(string $campo, array $valores): bool {
        if (key_exists($campo, $_POST)) {
            foreach ($valores as $valor) {
                if ($_POST[$campo] == $valor) {
                    return true;
                }
            }
            return false;
        }
    }

    /**
     * Cpmprueba si el input esta vacio.
     * @access public
     * @param string $campo Campo a comprobar.
     * @return string Valor del campo.
     */

    public function emptyInput(string $campo): string {
        if (key_exists($campo, $_POST)) {
            return $_POST[$campo];
        }
        throw new Exception("Campo $campo vacio");
    }

    /**
     * Limpia los datos antes de mostrarlos en la página.
     * @access public
     * @param string $data Dato a limpiar.
     * @return string Dato limpio.
     */
    public function clean(string $data): string {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    /**
     * Comprueba si se escogio un option dentro del rango de valores.
     * @access public
     * @param string $campo nombre del select a es igual a uno de los valores de un array. comprobar.
     * @param array $valores Rango de valores válidos.
     * @return bool true si el valor es correcto y false si no.
     */
    public function existCorrectOption(string $campo, array $valores) {
        if (isset($_POST[$campo])) {
            foreach ($valores as $valor) {
                if ($valor == $_POST[$campo]) {
                    return true;
                }
            }
        }
        return false;
    }
}

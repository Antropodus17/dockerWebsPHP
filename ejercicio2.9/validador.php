<?php

declare(strict_types=1);


/**
 * Clase Validador
 */
class Validador {


    /**
     * Comprueba si un valor es igual al valor de un array en una clave determinada.
     * @param array $array Array en el que se va a buscar.
     * @param string|int $key Clave en la que se va a buscar.
     * @param mixed $value Valor que se va a comparar.
     * @return bool true si el valor es igual al valor del array en la clave determinada.
     */
    public static function comprobarValorArray(array $array, string|int $key, mixed $value): bool {
        if (isset($array[$key]) && $array[$key] == $value) {
            return true;
        }
        return false;
    }

    /**
     * Comprueba si input radio/checbox esté seleccionado.
     * @param string $campo Campo a comprobar.
     * @param string $valor Valor a comprobar.
     * @return string "checked" si el campo está seleccionado.
     */
    public static function checkInputRadio(string $campo, string $valor): string {
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
    public static function checkEmptyInput(string $campo): string {
        if (key_exists($campo, $_POST)) {
            return $_POST[$campo];
        }
        throw new Exception("Campo $campo vacio");
    }

    /**
     * Limpia los datos antes de mostrarlos en la página.
     * @param string $data Dato a limpiar.
     * @return string Dato limpio.
     */
    public static function clean(string $data): string {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}

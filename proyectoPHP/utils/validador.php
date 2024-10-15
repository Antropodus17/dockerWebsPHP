<?php

declare(strict_types=1);
//IMPORTS
require_once("errors/GeneratorPercentageException.php");
require_once("errors/GeneratorUdsException.php");

/**
 * Clase Validador
 */
class Validador {

    /**
     * Limpia los datos antes de mostrarlos en la página.
     * @access public
     * @param string $data Dato a limpiar.
     * @return string Dato limpio.
     */
    public static function clean(string $data): string {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    public function validatePercentage(float $value): bool {
        return $value >= 0 && $value <= 250;
    }


    public function validateCantity(int $value): bool {
        return $value >= 0;
    }


    public function validateGeneratorForm(string $index): bool {

        if (!is_int(intval($_POST[$index])) || !$this->validateCantity(intval($_POST[$index]))) {
            throw new GeneratorUdsException("Invalid Uds");
        } else if (!is_float(floatval($_POST[($index . 'Percentage')])) || !$this->validatePercentage(floatval($_POST[$index . 'Percentage']))) {
            throw new GeneratorPercentageException("Invalid Percentage");
        }
        return true;
    }

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
     * 
     */
    function validateUser() {
        global $estado;
        $estado = "Validating User";

        if (null === Validador::clean($_POST["user"])) {
            throw new UserException("Wrong user");
        }
    }
}

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

    public function validatePercentage(int $value): bool {
        return $value >= 0 && $value <= 250;
    }


    public function validateCantity(int $value): bool {
        return $value >= 0;
    }


    public function validateGeneratorForm(string $index): bool {

        if (!is_int(intval($_POST[$index])) && !$this->validatePercentage(intval($_POST[$index]))) {
            throw new GeneratorUdsException("Invalid Uds");
        } else if (!is_int(intval($_POST[($index . 'Percentage')])) && !$this->validateCantity(intval($_POST[$index + 'Percentage']))) {
            throw new GeneratorPercentageException("Invalid Percentage");
        }
        return true;
    }
}

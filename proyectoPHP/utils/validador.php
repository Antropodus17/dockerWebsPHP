<?php

declare(strict_types=1);
//IMPORTS
require_once("errors/GeneratorPercentageException.php");
require_once("errors/GeneratorUdsException.php");
require_once("errors/PasswordException.php");
require_once("errors/UserException.php");

/**
 * Clase Validador que contiene funciones para validar datos.
 * @package proyectoPHP/utils
 * @author A23SergioPN
 */
class Validador {

    //PROPERTIES

    /**
     * Array con los usuarios de la base de datos.
     * @var array $usersDatabase
     * @access private
     */
    private array $usersDatabase = [
        "root" => "abc123.",
        "user" => "prueba"
    ];


    //FUNCTIONS

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

    /**
     * Valida si un valor es un porcentaje del rango.
     * @access public
     * @param float $value Valor a validar.
     * @return bool true si el valor es un porcentaje del rango.
     */
    public function validatePercentage(float $value): bool {
        return $value >= 0 && $value <= 250;
    }

    /**
     * Valida si un valor es una cantidad positiva de recursos.
     * @access public
     * @param int $value Valor a validar.
     * @return bool true si el valor es una cantidad positiva de recursos.
     */
    public function validateCantity(int $value): bool {
        return $value >= 0;
    }

    /**
     * Valida si los datos de un formulario de generadores son correctos.
     * @access public
     * @param string $index Índice del generador del formulario.
     * @return bool true si los datos del formulario son correctos.
     * @throws GeneratorUdsException si la cantidad de recursos es incorrecta.
     * @throws GeneratorPercentageException si el porcentaje es incorrecto.
     */
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
     * Valida si el usuario existe en la base de datos.
     * @access public
     * @param string $user Usuario a validar.
     * @throws UserException si el usuario no existe.
     * @return void
     */
    public function validateUserLogin(string $user) {
        $user = Validador::clean($user);
        if (null === $user || !isset($this->usersDatabase[$user])) {
            throw new UserException("Wrong user");
        }
    }



    /**
     * Valida si la contraseña es correcta para un usuario.
     * @access public
     * @param string $user Usuario de la contraseña.
     * @param string $password Contraseña a validar.
     * @throws PasswordException si la contraseña es incorrecta.
     * @return void
     */
    public function validatePasswordLogin(string $user, string $password) {
        if (!$this->comprobarValorArray($this->usersDatabase, Validador::clean($user), Validador::clean($_POST["paswd"]))) {
            throw new PasswordException("Wrong password");
        }
    }
}

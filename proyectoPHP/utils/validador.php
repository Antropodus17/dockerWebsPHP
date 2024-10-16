<?php

declare(strict_types=1);
//IMPORTS
require_once("errors/GeneratorPercentageException.php");
require_once("errors/GeneratorUdsException.php");
require_once("errors/PasswordException.php");
require_once("errors/UserException.php");

/**
 * Validator class that contains functions to validate data.
 * @package proyectoPHP\utils
 * @author A23SergioPN
 */
class Validador {

    //PROPERTIES

    /**
     * Array with the users in the database.
     * @var array $usersDatabase
     * @access private
     */
    private array $usersDatabase = [
        "root" => "abc123.",
        "user" => "prueba"
    ];


    //FUNCTIONS

    /**
     * Cleans the data before displaying it on the page.
     * @access public
     * @param string $data Data to clean.
     * @return string Cleaned data.
     */
    public static function clean(string $data): string {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    /**
     * Validates if a value is a percentage within the range.
     * @access public
     * @param float $value Value to validate.
     * @return bool true if the value is a percentage within the range.
     */
    public function validatePercentage(float $value): bool {
        return $value >= 0 && $value <= 250;
    }
    /**
     * Validates if a value is a positive quantity of resources.
     * @access public
     * @param int $value Value to validate.
     * @return bool true if the value is a positive quantity of resources.
     */
    public function validateCantity(int $value): bool {
        return $value >= 0;
    }
    /**
     * Validates if the data of a generator form is correct.
     * @access public
     * @param string $index Index of the generator in the form.
     * @return bool true if the form data is correct.
     * @throws GeneratorUdsException if the quantity of resources is incorrect.
     * @throws GeneratorPercentageException if the percentage is incorrect.
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
     * Checks if a value is equal to the value of an array at a given key.
     * @access public
     * @param array $array Array in which to search.
     * @param string|int $key Key at which to search.
     * @param mixed $value Value to compare.
     * @return bool true if the value is equal to the value of the array at the given key.
     */
    public function comprobarValorArray(array $array, string|int $key, mixed $value): bool {
        if (isset($array[$key]) && $array[$key] == $value) {
            return true;
        }
        return false;
    }


    /**
     * Validates if the user exists in the database.
     * @access public
     * @param string $user User to validate.
     * @throws UserException if the user does not exist.
     * @return void
     */
    public function validateUserLogin(string $user) {
        $user = Validador::clean($user);
        if (null === $user || !isset($this->usersDatabase[$user])) {
            throw new UserException("Wrong user");
        }
    }


    /**
     * Validates if the password is correct for a user.
     * @access public
     * @param string $user User of the password.
     * @param string $password Password to validate.
     * @throws PasswordException if the password is incorrect.
     * @return void
     */
    public function validatePasswordLogin(string $user, string $password) {
        if (!$this->comprobarValorArray($this->usersDatabase, Validador::clean($user), Validador::clean($_POST["paswd"]))) {
            throw new PasswordException("Wrong password");
        }
    }
}

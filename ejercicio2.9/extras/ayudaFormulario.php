<?php

declare(strict_types=1);
require_once("./validador.php");

class AyudaFormulario {

    //PROPIEDADES

    private Validador $validador;

    //CONSTRUCTOR

    /**
     * 
     */
    function __construct() {
        $validador = new Validador();
    }

    //SETTERS & GETTERS

    /**
     * 
     */
    public function getValidador(): Validador {
        return $this->validador;
    }


    /**
     * Crea un select con los valores de un array.
     * @access public
     * @param array $array Array con los valores.
     * @param string $name nombre del select.
     * @return void
     */
    public function createSelect(string $name, array $array): bool {
        global $validador;
        echo "<select name='$name' >";
        echo "<option disable value='0' selected>Select option </option>";
        foreach ($array as $name => $value) {
            echo "<option value= $value " . $validador . " >$name</option>";
        }
        echo "</select>";
        return true;
    }

    /**
     * Crea un input general.
     * @access public
     * @param string $name Nombre del input.
     * @param string $type Tipo del input default 'text'.
     * @param string $value Valor del input default ''.
     * @return bool
     */
    public function createGeneralInput(string $name, string $type = "text", string  $value = ""): bool {
        echo "<label for= $name> $name </label>";
        echo "<input type= $name name= $name value= $value >";
        return true;
    }

    /**
     * Crea un input radio o checkbox.
     * @access public
     * @param string $name Nombre del input.
     * @param string $type Tipo del input.
     * @param array $values Valores del input.
     * @return void
     */
    public function createRadioCheckboxInput(string $name, string $type, array $values) {
        echo "<label for= $name>Please specify your $name</label>";
        foreach ($values as $value) {
            echo "<input type= $type name= $name value= $value >";
        }
    }
}

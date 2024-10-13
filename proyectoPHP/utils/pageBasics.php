<?php

declare(strict_types=1);


//IMPORTS
require_once("menciones.php");

/**
 * Class PageBasics
 * a class to create the basic structure of the web
 * @package proyectoPHP/utils
 * @version 1.0
 */
class PageBasics {

    //ATTRIBUTE
    /**
     * @var Mentions $mentions to print the mentions of the icons.
     * @access public 
     * @link proyectoPHP/utils/menciones.php
     */
    public Mentions $mentions;

    public Validador $validador;

    //CONSTRUCTOR
    /**
     * PageBasics constructor.
     * @access public
     */
    function __construct() {
        $this->mentions = new Mentions();
        $this->validador = new Validador();
    }
    //FUNCTIONS
    /**
     * Create the main header of the web
     * @access public
     */
    public function createHeader(): void {
        echo '<header>';
        echo "<a href='/proyectoPHP/'><img src='/proyectoPHP/img/satisfactory logo.png' alt='Logo'></a>
        <h3>Satisfactory Calculator</h3><section>";
        if (isset($_SESSION["user"])) {
            echo "<img src='/proyectoPHP/img/defaultLogin.png'alt='Foto de sesion'>";
        } else if ($_SERVER["PHP_SELF"] === "") {
            echo "<a href='/proyectoPHP/auth/login.php'><img src='/proyectoPHP/img/makeLogin.png'alt='Foto de sesion'></a>";
        }
        echo "</section>";
        echo '</header>';
    }
    /**
     * Create the main footer of the web
     * @access public
     */
    public function createFooter() {
        echo "<footer>";
        $this->mentions->start();
        echo '</footer>';
    }


    public function createSelect(string $name, array $objects) {
        echo "<select name='$name' >";
        echo "<option disable value='0' selected>Select option </option>";
        foreach ($objects as $key => $value) {
            echo "<option value= $key";
        }
        echo "</select>";
    }
}

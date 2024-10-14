<?php

declare(strict_types=1);


//IMPORTS
require_once("menciones.php");
require_once("satisfactoryObjects.php");
require_once("validador.php");

/**
 * Class PageBasics
 * a class to create the basic structure of the web
 * @package proyectoPHP/utils
 * @version 1.0
 */
class PageBasics {

    public static int $indiceForm = 0;

    //ATTRIBUTE
    /**
     * @var Mentions $mentions to print the mentions of the icons.
     * @access public 
     * @link proyectoPHP/utils/menciones.php
     */
    public Mentions $mentions;

    public Validador $validador;

    public SatisfactoryObjects $dataBase;

    //CONSTRUCTOR
    /**
     * PageBasics constructor.
     * @access public
     */
    function __construct() {
        $this->mentions = new Mentions();
        $this->validador = new Validador();
        $this->dataBase = new SatisfactoryObjects();
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
            echo "<a href='/proyectoPHP/auth/logout.php'><img src='/proyectoPHP/img/defaultLogin.png'alt='Foto de sesion'></a>";
        } else if ($_SERVER["PHP_SELF"] === "/proyectoPHP/auth/login.php") {
        } else {
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

    /**
     * Create a form to select the resources and the quantity of the resources.
     * @access public
     */
    public function createResourcesForm(): void {
        echo "<form action=" . $_SERVER["PHP_SELF"] . " method='post'>";
        echo "<select name='resource" . $this::$indiceForm . "'>";
        echo "<option disable value='0' selected>Select Resurce </option>";
        foreach ($this->dataBase->resources as $key => $value) {
            echo "<option value=$key> " . $this->dataBase->getResourcesName($key) . " </option>";
        }
        echo "</select>";
        echo "<input type='number' name='cantidad" . $this::$indiceForm . "'></input>";
        echo "<input type='submit' value='Calcular'></input>";
        echo "</form>";
    }


    public function createGeneratorForm(): void {
        echo "<form action=" . $_SERVER["PHP_SELF"] . " method='post'>";
        echo "<article>";
        foreach ($this->dataBase->generators as $index => $generator) {
            echo "<section index=" . $this::$indiceForm++ . ">";
            echo "<label for='$index'>$generator[0]</label>";
            echo "<entrada><input type='number' name='$index'>Cantidad</input></entrada>";
            echo "<entrada><input type='number' name='" . $index . "Percentage'>Rendimiento(%)</input></entrada>";
            echo "</section>";
        }
        echo "</article>";
        echo "<input type='submit' value='Calcular'>";
        echo "</form>";
    }

    /**
     * Echo the basic css of the web.
     */
    public static function basicCss() {
        echo "<link rel='stylesheet' href='/proyectoPHP/styles/main.css'>";
        echo "<link rel='stylesheet' href='/proyectoPHP/styles/headerFooter.css'>";
    }
}

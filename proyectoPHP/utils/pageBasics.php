<?php

declare(strict_types=1);


//IMPORTS
require_once("menciones.php");
require_once("satisfactoryObjects.php");
require_once("validador.php");
require_once("Calculator.php");

/**
 * Class PageBasics
 * a class to create the basic structure of the web
 * @package proyectoPHP/utils
 * @author A23SergioPN
 */
class PageBasics {

    /**
     * @var int $indiceForm to create the index of the form progresive for future forms.
     * @access public
     * @static
     */
    public static int $indiceForm = 0;

    //ATTRIBUTE
    /**
     * @var Mentions $mentions to print the mentions of the icons.
     * @access public 
     */
    public Mentions $mentions;

    /**
     * @var Validador $validador to validate the data.
     * @access public
     */
    public Validador $validador;

    /**
     * @var SatisfactoryObjects $dataBase to simulate a data base for the objects of the game.
     * @access public
     */
    public SatisfactoryObjects $dataBase;

    /**
     * @var Calculator $calculator to the calculations of the forms.
     * @access public
     */
    public Calculator $calculator;


    //CONSTRUCTOR
    /**
     * PageBasics constructor.
     * @access public
     */
    function __construct() {
        $this->mentions = new Mentions();
        $this->validador = new Validador();
        $this->dataBase = new SatisfactoryObjects();
        $this->calculator = new Calculator();
    }
    //FUNCTIONS
    /**
     * Create the main header of the web
     * @access public
     */
    public static function createHeader(): void {
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
     * @static
     * @return void
     */
    public static function createFooter() {
        echo "<footer>";
        $mentions = new Mentions();
        $mentions->start();
        echo '</footer>';
    }

    /**
     * Create a form to select the resources and the quantity of the resources.
     * @access public
     * @return void
     */
    public function createResourcesForm(): void {
        echo "<h1>Resources Calculator</h1>";
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

    /**
     * Create a form to select the generators, the quantity and the percentage of the generators.
     * @access public
     * @return void
     */
    public function createGeneratorForm(): void {
        echo "<form action=" . $_SERVER["PHP_SELF"] . " method='post'>";
        echo "<article>";
        foreach ($this->dataBase->generators as $index => $generator) {
            echo "<section index=" . $this::$indiceForm++ . ">";
            echo "<label for='$index'>$generator[0]</label>";
            echo "<entrada><input type='number' name='$index'>Cantidad</input></entrada>";
            echo "<entrada><input type='number' name='" . $index . "Percentage'>Rendimiento(0-250%)</input></entrada>";
            try {
                if ($_SERVER["REQUEST_METHOD"] === "POST") {
                    $this->validador->validateGeneratorForm($index);
                    $this->calculator->calculateGenerator($index, intval($_POST[$index]), floatval($_POST[$index . "Percentage"]));
                }
            } catch (GeneratorUdsException $e) {
                echo "<section class='answer'>" . $e->getMessage() . "</section class='answer'>";
            } catch (GeneratorPercentageException $e) {
                echo '<section class="answer">' . $e->getMessage() . '</section class="answer">';
            }
            echo "</section>";
        }
        echo "</article>";
        echo "<input type='submit' value='Calcular'>";
        echo "</form>";
    }

    /**
     * Create the login form.
     * @access public
     * @return void
     */
    public function createLogin(): void {
        $validate = false;
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $validate = true;
        }
        echo '<form action=' . $_SERVER["PHP_SELF"] . ' method="post">';
        echo '<section class="entrada">';
        echo '<label for="user">User: </label>';
        echo '<input type="text" name="user" id="iUser">';
        if ($validate) {
            try {
                $this->validador->validateUserLogin($_POST["user"]);
            } catch (UserException $e) {
                echo '<section class="error">' . $e->getMessage() . '</section>';
            }
        }
        echo '</section><br>';
        echo '<section class="entrada">';
        echo '<label for="paswd">Password: </label>';
        echo '<input type="password" name="paswd" id="iPaswd">';
        if ($validate) {
            try {
                $this->validador->validatePasswordLogin($_POST["user"], $_POST["paswd"]);
                $this->loginSucces();
            } catch (PasswordException $e) {
                echo '<section class="error">' . $e->getMessage() . '</section>';
            }
        }
        echo '</section><br>';
        echo '<section class="enviar">';
        echo '<input type="submit" value="Iniciar Sesion">';
        echo '</section>';
        echo '</form>';
    }

    /**
     * Redirect to the last page or to the index.
     * @access public
     * @return void
     */
    public function loginSucces() {
        $_SESSION["user"] = Validador::clean($_POST["user"]);
        if (isset($_COOKIE["noUser"])) { //RETURN TO THE LAST PAGE
            $redirect = ""  .  $_COOKIE["noUser"];
            setcookie("noUser", "", -1);
            header("Location: $redirect");
            throw new Exception("Error Processing Request", 1);
        } else { //RETURN TO THE INDEX
            header("Location: /proyectoPHP");
            throw new Exception("Error Processing Request2", 1);
        }

        exit();
    }



    /**
     * Echo the basic css of the web.
     * @access public
     * @static
     * @return void
     */
    public static function basicCss() {
        echo "<link rel='stylesheet' href='/proyectoPHP/styles/main.css?'>";
    }
}

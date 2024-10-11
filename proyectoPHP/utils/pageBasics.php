<?php

declare(strict_types=1);


//IMPORTS
require_once("menciones.php");

class PageBasics {

    //ATTRIBUTE
    public Mentions $mentions;

    function __construct() {
        $this->mentions = new Mentions();
    }
    //FUNCTIONS
    /**
     * 
     */
    public function createHeader(): void {
        echo '<header>';
        echo "<a href='/proyectoPHP/'><img src='/proyectoPHP/img/satisfactory logo.png' alt='Logo'></a>
        <h3>Satisfactory</h3>";
        if (isset($_SESSION["user"])) {
            echo "<section><img src='/proyectoPHP/img/defaultLogin.png'alt='Foto de sesion'>";
        }
        echo '</header>';
    }
    /**
     * 
     */
    public function createFooter() {
        echo "<footer>";
        $this->mentions->start();
        echo '</footer>';
    }
}

<?php

declare(strict_types=1);
session_start();

//IMPORTS
require_once("./menciones.php");

class PageBasics {

    //ATTRIBUTE
    public Mentions $mentions = new Mentions();


    //FUNCTIONS
    /**
     * 
     */
    public function createHeader(): void {
        echo "<header>
        <img src='../img/satisfactory logo.png' alt='Logo'>
        <h3>$</h3>
        <section></section>
    </header>";
    }


    /**
     * 
     */
    public function createFooter() {

        $this->mentions->start();
    }
}

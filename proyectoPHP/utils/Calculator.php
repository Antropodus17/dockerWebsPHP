<?php

//IMPORTS
require_once("satisfactoryObjects.php");

/**
 * Class Calculator
 * a class to calculate the resources needed to create a product and the total energy.
 */
class Calculator {

    //ATRIBUTE

    /**
     * @var SatisfactoryObjects $dataBase to get the data from the 'database'.
     * @access public
     * @link proyectoPHP/utils/satisfactoryObjects.php
     */
    public SatisfactoryObjects $dataBase;


    //CONSTRUVCTOR

    /**
     * Calculator constructor.
     * @access public
     */
    public function __construct() {
        $this->dataBase = new SatisfactoryObjects();
    }

    //FUNCTIONS

    /**
     * Calculate the resources needed to create the total of a product.
     * @param string $resource the product to create.
     * @param int $uds the total of products to create.
     * @access public
     * @return void
     */
    public function calculateReources(string $resource, int $uds): void {
        $ingredients = $this->dataBase->getIngredients($resource);
        $razon = ceil($uds / $this->dataBase->getUds($resource));
        echo "<section class='answer'>";
        echo "<p><strong>For $uds uds of $resource you need:</strong></p>";
        echo "<ul>";
        foreach ($ingredients as $ingredient) {
            echo "<li>$ingredient[0]: " . $ingredient[1] * $razon . " uds</li>";
        }
        echo "</ul>";
        echo "</section";
    }
}

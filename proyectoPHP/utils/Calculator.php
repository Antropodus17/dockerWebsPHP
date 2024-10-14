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
     * Calculate and show the resources needed to create the total of a product.
     * @param string $resource the product to create.
     * @param int $uds the total of products to create.
     * @param int $level the level of the presentation of the product.
     * @access public
     * @return void
     */
    public function calculateResources(string $resource, int $uds, int $level = 0): void {
        $crecimientoColor = 20 * $level;
        $ingredients = $this->dataBase->getIngredients($resource);
        $razon = ceil($uds / $this->dataBase->getUds($resource));
        echo "<section class='answer' level='$level' style='background-color: rgb( " . 248 + $crecimientoColor . ", " . 159 + $crecimientoColor . ", " . 84 + $crecimientoColor . ")'>";
        echo "<p><strong>For $uds uds of " . $this->dataBase->getResourcesName($resource) . " you need:</strong></p>";
        echo "<ul>";
        foreach ($ingredients as $ingredient) {
            echo "<li>$ingredient[0]: " . $ingredient[1] * $razon . " uds</li>";
        }
        echo "</ul>";
        foreach ($ingredients as $ingredient) {
            if ($ingredient[2]) {
                $this->calculateResources($this->dataBase->getIndex($ingredient[0]), $ingredient[1] * $razon, $level + 1);
            }
        }
        echo "</section>";
    }
}

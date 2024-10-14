<?php

declare(strict_types=1);

/**
 * Class SatisfactoryObjects to simulate a data base for the objects of the game.
 */
class SatisfactoryObjects {

    //ATRIBUTES

    /**
     * Array simulating the resources of the game.
     */
    public array $resources;

    /**
     * Array simulating the generators of the game.
     */
    public array $generators;

    //CONSTRUCTOR
    function __construct() {
        $this->resources = [
            "PlanchaHierro" => [["Plancha de Hierro", 3], [["Lingote de Hierro", 2, false]]],
            "BarraHierro" => [["Barra de Hierro", 2], [["Lingote de Hierro", 1, false]]],
            "Tornillos" => [["Tornillos", 5], [["Barra de Hierro", 1, true]]],
            "PlanchaHierroReforzada" => [["Plancha de Hierro Reforzada", 1], [["Plancha de Hierro", 1, true], ["Tornillos", 25, true]]]
        ];
        $this->generators = [
            "QuemadorBiomasa" => ["Quemador de biomasa", 30],
            "QuemadorCarbón" => ["Quemador de Carbón", 175],
            "QuemadorCombustible" => ["Quemador de Combustible", 350]
        ];
    }

    //GETTERS

    /**
     * Get the name of the resource.
     * @param string $index Index of the resource.
     * @return string Name of the resource.
     * @access public
     */
    public function getResourcesName(string $index): string {
        return $this->resources[$index][0][0];
    }

    /**
     * Get the name of the generator.
     * @param string $index Index of the generator.
     * @return string Name of the generator.
     * @access public
     */
    public function getGeneratorName(string $index): string {
        return $this->generators[$index][0];
    }

    /**
     * Get the index of a name.
     * @param string $name Name of the object.
     * @return string Index of the object.
     * @access public
     */
    public function getIndex(string $name): string {
        $index = str_replace(" de ", "", $name);
        $index = str_replace(" ", "", $index);
        return $index;
    }

    /**
     * Get the uds of a resource.
     * @param string $index Index of the resource.
     * @return int Uds of the resource.
     * @access public
     */
    public function getUds(string $index): int {
        return $this->resources[$index][0][1];
    }

    /**
     * Get the ingredients of a resource.
     * @param string $index Index of the resource.
     * @return array Ingredients of the resource.
     * @access public
     */
    public function getIngredients(string $index): array {
        return $this->resources[$index][1];
    }
}

<?php

declare(strict_types=1);

/**
 * 
 */
class SatisfactoryObjects {

    //ATRIBUTES

    public array $objects;

    public array $generators;

    //CONSTRUCTOR
    function __construct() {
        $objects = ["0" => [["Plancha de hierro", 3], ["Lingote de hierro", 2]]];
        $generators = ["0" => ["Quemador de biomasa", 30]];
    }
}

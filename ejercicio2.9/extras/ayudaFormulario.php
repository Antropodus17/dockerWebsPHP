<?php

declare(strict_types=1);

class ayudaFormulario
{

    /**
     * Crea un select con los valores de un array.
     * @param array $array Array con los valores.
     * @param string $name nombre del select.
     * @return void
     */
    public static function createSelect(array $array, string $name,)
    {
        echo "<select name='$name' >";
        echo "<option disable value='' selected>Select option </option>";
        foreach ($array as $name => $value) {
            echo "<option value='$value'>$name</option>";
        }
        echo "</select>";
    }

    public static function createGeneralInput() {
        
    }
}

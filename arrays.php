<?php

declare(strict_types=1);
function tripleCheck(array $array): bool
{
    $tamaño = count($array) - 1;
    $elementoPasado = 0;
    $conteo = 0;
    $devolver=false;
    for (; $tamaño > 0; --$tamaño) {
        if ($elementoPasado == $array[$tamaño]) {
            $conteo++;
        } else {
            $elementoPasado = $array[$tamaño];
            $conteo = 0;
        }
        if ($conteo == 2) {
            $devolver=true;
        }
    }
    return $devolver;
}
function countries($array)
{
    foreach ($array as $key => $value) {
        echo "The capital of " . $key . " is" . $value."<br>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    $array1 = [1, 1, 2, 4, 5, 6, 7, 7, 8, 9,1];
    $array2 = [1, 2, 1, 3, 3, 3, 7, 8, 5, 5];
    echo "<h2>Triple check</h2>";
    echo "<p>[1,1,2,4,5,6,7,7,8,9,1]</p>";
    echo "<p>Check: </p>";
    echo var_dump(tripleCheck($array1));
    echo "<p>[1,2,1,3,3,3,7,8,5,5]</p>";
    echo "<p>Check: </p>";
    echo var_dump(tripleCheck($array2)) 
    ?>
    <br><br><br><br><br>
    <?php
    echo "<h2>Countries</h2>";
    echo '"Italy"=>"Rome", "Luxembourg"=>"Luxembourg", "Belgium"=> "Brussels", "Denmark"=>"Copenhagen", "Finland"=>"Helsinki", "France" => "Paris", "Slovakia"=>"Bratislava", "Slovenia"=>"Ljubljana", "Germany" => "Berlin", "Greece" => "Athens", "Ireland"=>"Dublin", "Netherlands"=>"Amsterdam", "Portugal"=>"Lisbon", "Spain"=>"Madrid", "Sweden"=>"Stockholm", "United Kingdom"=>"London", "Cyprus"=>"Nicosia", "Lithuania"=>"Vilnius", "Czech Republic"=>"Prague", "Estonia"=>"Tallin", "Hungary"=>"Budapest", "Latvia"=>"Riga", "Malta"=>"Valetta", "Austria" => "Vienna", "Poland"=>"Warsaw"';
    $cuntries = (["Italy"=>"Rome", "Luxembourg"=>"Luxembourg", "Belgium"=> "Brussels", "Denmark"=>"Copenhagen", "Finland"=>"Helsinki", "France" => "Paris", "Slovakia"=>"Bratislava", "Slovenia"=>"Ljubljana", "Germany" => "Berlin", "Greece" => "Athens", "Ireland"=>"Dublin", "Netherlands"=>"Amsterdam", "Portugal"=>"Lisbon", "Spain"=>"Madrid", "Sweden"=>"Stockholm", "United Kingdom"=>"London", "Cyprus"=>"Nicosia", "Lithuania"=>"Vilnius", "Czech Republic"=>"Prague", "Estonia"=>"Tallin", "Hungary"=>"Budapest", "Latvia"=>"Riga", "Malta"=>"Valetta", "Austria" => "Vienna", "Poland"=>"Warsaw"]);
    countries($cuntries);
    
    ?>
</body>

</html>
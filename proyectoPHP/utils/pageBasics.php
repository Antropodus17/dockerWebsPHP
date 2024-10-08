<?php 
declare(strict_types=1);

class pageBasics {


public static function createHeader(string $imgPath,string $title) : void {
    echo "<header>
        <img src='$imgPath' alt='Logo'>
        <h3>$title</h3>
    </header>";
}


}
?>
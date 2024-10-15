<?php

declare(strict_types=1);

session_start();

//IMPORTS
require_once("./utils/pageBasics.php");




?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Satisfactory calculator</title>
    <?php PageBasics::basicCss() ?>
</head>

<body>
    <header>
        <?php
        $pageBasics = new PageBasics();
        $pageBasics->createHeader()
        ?>
    </header>
    <main>
        <h1>Welcome to the satisfactory Calculator</h1>
        <p>A page decdicated to help people to planify their fabrics </p>
        <a href="http://localhost/proyectoPHP/src/resoursesCalculator.php">
            <section>
                <h2>Resources Calculator</h2>
                <img src="http://localhost/proyectoPHP/img/" alt="">
            </section>
        </a><a href="http://localhost/proyectoPHP/src/energyCalculator.php">
            <section>
                <h2>Energy Calculator</h2>
                <img src="http://localhost/proyectoPHP/img/" alt="">
            </section>
        </a>
    </main>
    <footer>

    </footer>
</body>

</html>
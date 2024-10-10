<?php

declare(strict_types=1);
session_start();
if (!isset($_SESSION["user"])) { //COMPROBATE IF SESSION IS STARTED
    setcookie("noUser", $_SERVER["PHP_SELF"], time() + 60 * 60, "/");
    header("Location: http://localhost/proyectoPHP/auth/login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Energy Calculator</title>
    <p><?php echo $_SESSION["user"]; ?></p>
</head>

<body>

    <?php
    $pageBasics = new PageBasics();
    $pageBasics->createFooter();
    ?>
</body>

</html>
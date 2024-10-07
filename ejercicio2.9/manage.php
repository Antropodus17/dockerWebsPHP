<?php

declare(strict_types=1);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <main>
        <p><?php echo $_POST['nombre']; ?> wants to enrol in the following subjects: <?php echo $_POST['subjectN'] ?></p>
        <?php echo $_SERVER['HTTP_REFERER'] == 'http://localhost/ejercicio2.9/formulario.php' ? "<a href='./manage2.php?nombre=" . $_POST['nombre'] . "&subjectV=" . $_POST['subjectV'] . "" . ($_SERVER['HTTP_REFERER'] == "http://localhost/ejercicio2.9/manage2.php" ? "and " . $_POST['clases'] . " classes" : "") . "'>Continue</a>" : ""; ?>

    </main>
</body>

</html>
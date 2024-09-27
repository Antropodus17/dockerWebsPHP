<?php

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<html>

<body>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        echo 'Welcome ' . test_input($_POST["vNome"]) . '<br>';
        echo 'Your email address is: ' . test_input($_POST["vEmail"]);
    } else { ?>
    <?php echo (empty($_GET[0]) ? "Hola Mundo" : "Adios Mundo") ; ?>
        <form action="verificar.php" method="post">
            Name: <input type="text" name="vNome"><?php echo (empty($_GET[""]) ? "" : "<span>".$_GET["eNome"]."</span>") ; ?>
            <br> 
            E-mail: <input type="text" name="vEmail" ><?php echo (empty($_GET[""]) ? "" : "<span>".$_GET["eEmail"]."</span>") ; ?>
            <br>
            <input type="submit" name="enviar" value="Send data">
        </form>
    <?php } ?>

</body>

</html>
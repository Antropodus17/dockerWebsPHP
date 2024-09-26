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
        <form action="verificar.php" method="post">
            Name: <input type="text" name="vNome" required>
            <br>
            E-mail: <input type="text" name="vEmail" >
            <br>
            <input type="submit" name="enviar" value="Send data">
        </form>
    <?php } ?>

</body>

</html>
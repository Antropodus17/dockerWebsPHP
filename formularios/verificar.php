<?php

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$check = true;
$nameErr = $emailErr = "";?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>verificar</title>
</head>
</html>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["vNome"])) {
        $nameErr = "Name is required";
        $check = false;
    } else {
        $name = test_input($_POST["vNome"]);
    }

    if (empty($_POST["vEmail"])) {
        $emailErr = "Email is required";
        $check = false;
    } else {
        $email = test_input($_POST["vEmail"]);
    }
    if($check){?>
        <form action="fusion.php" method="post" name="formCorrecto">
            <input type="hidden" name="vNome" value=<?php $name ?>>
            <input type="hidden" name="vEmail" value=<?php $email ?>>
            <input type="submit" value="enviar2" style="display: none;">
        </form>
        <script>    
            document.forms.namedItem("formCorrecto").submit();
        </script>
<?php } 
} ?>


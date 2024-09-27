<?php

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$check = true;
$nameErr = $emailErr = ""; ?>
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
    // VERIFIADO DEL NOMBRE
    if (empty($_POST["vNome"])) {
        $nameErr = "Name is required";
        $check = false;
    } else { //GUARDADO DEL NOMBRE
        $name = test_input($_POST["vNome"]);
    }
    // VERIFICADO DEL EMAIL
    if (empty($_POST["vEmail"])) {
        $emailErr = "Email is required";
        $check = false;
    } else { //GUARDADO DEL EMAIL
        $email = test_input($_POST["vEmail"]);
    }
    if ($check) { ?>
        <form action="fusion.php" method="post" name="respuesta">
            <input type="hidden" name="vNome" value=<?php echo $name ?>>
            <input type="hidden" name="vEmail" value=<?php echo $email ?>>
            <input type="submit" value="enviar1" style="display: none;">
        </form>
    <?php } else { ?>
        <form action="fusion.php" method="get" name="respuesta">
            <input type="hidden" name="eNome" value=<?php echo $nameErr ?>>
            <input type="hidden" name="eEmail" value=<?php echo $emailErr ?>>
            <input type="submit" value="enviar2" style="display: none;">
        </form>
<?php }
} ?>
<script>
    document.forms.namedItem("respuesta").submit();
</script>
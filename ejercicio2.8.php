<?php

declare(strict_types=1);

require_once 'validador.php';


$formularioEnviado = false;

function validar($dato) {
    $validador = new Validador();
    $validador->clean($dato);
    return $dato;
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $formularioEnviado = true;
}

function revisarOpcion($campo, $valor) {
    if (key_exists($campo, $_POST)) {

        if ($valor == $_POST[$campo]) {
            return true;
        }
    }
    return false;
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forms II</title>
</head>

<body>
    <h1>Novell Services Login</h1>
    <form action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?> method="post">
        <label for="Username">Username</label><input type="text" name="Username" id="tUser" value=<?php echo $formularioEnviado ? validar($_POST["Username"]) : ""; ?>><br>
        <label for="Pasword">Password</label><input type="password" name="Pasword" id="tPass" value=<?php echo $formularioEnviado ? validar($_POST["Pasword"]) : ""; ?>><br>
        <label for="City">City of employment</label><input type="text" name="City" id="tCity" value=<?php echo $formularioEnviado ? validar($_POST["City"]) : ""; ?>><br>
        <label for="WebS">Web Server</label>
        <select name="WebS" id="tWebS">
            <option value="0" disabled <?php echo $formularioEnviado ? (revisarOpcion("WebS", "0") ? "selected" : "") : ""; ?>>--Choose a server--</option>
            <option value="Apache" <?php echo $formularioEnviado ? (revisarOpcion("WebS", "Apache") ? "selected" : "") : ""; ?>>Apache</option>
            <option value="IIS" <?php echo $formularioEnviado ? (revisarOpcion("WebS", "IIs") ? "selected" : "") : ""; ?>>IIS</option>
            <option value="Nginx" <?php echo $formularioEnviado ? (revisarOpcion("WebS", "Nginx") ? "selected" : "") : ""; ?>>Nginx</option>
            <option value="Tomcat" <?php echo $formularioEnviado ? (revisarOpcion("WebS", "Tomcat") ? "selected" : "") : ""; ?>>Tomcat</option>
        </select>
        <label for="role">Please specify your role</label>
        <div>
            <input type="radio" name="role" id="rAdmin" value="Admin" <?php echo $formularioEnviado ? (revisarOpcion("role", "Admin") ? "checked" : "") : ""; ?>>Admin</input>
            <input type="radio" name="role" id="rEngineer" value="Engineer" <?php echo $formularioEnviado ? (revisarOpcion("role", "Engineer") ? "checked" : "") : ""; ?>>Engineer</input>
            <input type="radio" name="role" id="rManager" value="Manager" <?php echo $formularioEnviado ? (revisarOpcion("role", "Manager") ? "checked" : "") : ""; ?>>Manager</input>
            <input type="radio" name="role" id="rGuest" value="Guest" <?php echo $formularioEnviado ? (revisarOpcion("role", "Guest") ? "checked" : "") : ""; ?>>Guest</input>
        </div>
        <label for="sign_in">Single sign in</label>
        <div>
            <input type="checkbox" name="Mail" id="cMail" <?php echo $formularioEnviado ? (revisarOpcion("Mail", "on") ? "checked" : "") : ""; ?>>Mail</input>
            <input type="checkbox" name="Payroll" id="cPayroll" <?php echo $formularioEnviado ? (revisarOpcion("Payroll", "on") ? "checked" : "") : ""; ?>>Payroll</input>
            <input type="checkbox" name="Self_service" id="cSelf-service" <?php echo $formularioEnviado ? (revisarOpcion("Self_service", "on") ? "checked" : "") : ""; ?>>Self-Service</input>
        </div>
        <input type="submit" value="enviar">
        <input type="reset" value="reset">
        <script>
            Document.addEventListener('DOMContentLoaded', () => {
                document.querySelector('input[type="reset"]').addEventListener('click', () => {
                    console.log("reset");
                    document.querySelectorAll('input[type="text"]').forEach((elemento) => {
                        elemento.value = "";
                    });
                    document.querySelectorAll('input[type="password"]').forEach((elemento) => {
                        elemento.value = "";
                    });
                    document.querySelectorAll('input[type="radio"]').forEach((elemento) => {
                        elemento.checked = false;
                    });
                    document.querySelectorAll('input[type="checkbox"]').forEach((elemento) => {
                        elemento.checked = false;
                    });
                    document.querySelectorAll('select').forEach((elemento) => {
                        elemento.selectedIndex = 0;
                    });
                });
            });
        </script>
    </form>
</body>

</html>
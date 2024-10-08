<?php 
declare(strict_types=1);

if (!isset($_SESSION["user"])) {//COMPROBATE IF SESSION IS STARTED
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
    <p><?php echo $_SESSION; ?></p>
</head>
<body>
    
</body>
</html>
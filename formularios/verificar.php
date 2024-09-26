<?php

$check=true;
$nameErr=$emailErr="";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["vNome"])) {
        $nameErr = "Name is required";
        $check=false;
    } else {
        $name = test_input($_POST["vNome"]);
    }

    if (empty($_POST["vEmail"])) {
        $emailErr = "Email is required";
        $check=false;
    } else {
        $email = test_input($_POST["vEmail"]);
    }
    return ;
}
?>

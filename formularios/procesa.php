<html>

<body>

    Welcome <?php echo test_input($_GET["vNome"]); ?><br>
    Your email address is: <?php echo test_input($_GET["vEmail"]); ?>

    <?php

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    ?>

    </form>
</body>

</html>
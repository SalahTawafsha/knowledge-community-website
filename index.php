<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Log in</title>
</head>

<body>
<?php
session_start();

// go to dashbord if there are email logged in
if (isset($_SESSION["email"]))
    header("location: dashboard");

?>
<center>
    <h2>Sign in Form</h2>

    <?php

    // handle errors that from login_process.php
    if (isset($_GET["error"])) {
        $error = $_GET["error"];
        if ($error == 1)
            echo "<h3>Uncorrect Passsword.</h3><br>";
        else
            echo "<h3>Email NOT Regested.</h3><br>";
    }

    // handle msgs that from sign_up_process.php
    if (isset($_GET["msg"])) {
        $msg = $_GET["msg"];
        if ($msg == 1)
            echo "<h3>Account Added.</h3><br>";
        else
            echo "<h3>Account is already exist.</h3><br>";
    }
    ?>

    <form method="POST" action="login_process.php">
        <fieldset style="width: 0">
            Email:
            <input type="email" name="email" required>
            <br><br>
            Password:
            <input type="password" name="password" required>
            <br><br>
            <input type="submit" value="login">
            <br><br>
            <a href="sign_up.php">Sign UP</a>
        </fieldset>
    </form>
    <br>
    <a href="./dashboard/search_functionality/">Browse knowladge base Without login</a>

</center>
</body>

</html>
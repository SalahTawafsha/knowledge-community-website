<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Log in</title>
</head>

<body>
    <center>
        <h2>Sign Up Form</h2>
        <?php
        if (isset($_GET["error"]))
            echo "<h3>Password must be more than 8 characters</h3><br>";
        ?>
        <form method="POST" action="sign_up_process.php">
            <fieldset style="width: 0;">
                Email:
                <input type="email" name="email" required>
                <br><br>
                Password:
                <input type="password" name="password" required>
                <br><br>
                <input type="submit" value="Sign UP">
            </fieldset>
        </form>
    </center>
</body>

</html>
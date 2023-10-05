<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>File Sharing</title>

</head>

<body>
    <center>

        <h1>File Sharing</h1>
        <?php
        session_start();

        // if go to URL of this page without login, then log out 
        if (!isset($_SESSION["email"]))
            header("location: ../../");

        // handle errors that may sent from process.php
        if (isset($_GET["error"])) {
            $error = $_GET["error"];
            if ($error == 1)
                echo "<h3>Can't Save File.</h3><br>";
            else if ($error == 2)
                echo "<h3>File is already exist, try to change it's name.</h3><br>";
            else
                echo "<h3>Unexpected error.</h3><br>";
        }
        ?>

        <p>Here, you can share files that you believe that may be useful for other users.</p>
        <form method="post" action="process.php" enctype="multipart/form-data">
            <fieldset style="width: 0;">
                Title:
                <br>
                <input type="text" name="title" required>
                <br><br>
                Description:
                <br>
                <textarea rows="6" name="description" required></textarea>
                <br><br>
                Keywords:
                <br>
                <textarea rows="3" name="keywords"></textarea>
                <br><br>
                File to Share:
                <input type="file" name="relevant_file_name" required>
                <br><br>
                <input type="submit">
            </fieldset>
        </form>
    </center>
</body>

</html>
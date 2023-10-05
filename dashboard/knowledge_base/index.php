<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Knowledge Base</title>

</head>

<body>
    <center>
        <h1>Publish something you want</h1>

        <?php

        session_start();

        // if go to URL of this page without login, then log out 
        if (!isset($_SESSION["email"]))
            header("location: ../../");

        // handle error that may sent from process.php
        if (isset($_GET["error"]))
            echo "<h3>Can't add, you have article with this title.</h3><br>";
        ?>

        <p>Here, You are allow to
            create and publish articles and will shown by other users to comment.</p>
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
                Body Text:
                <br>
                <textarea rows="6" name="body_text" required></textarea>
                <br><br>
                Keywords:
                <br>
                <textarea rows="3" name="keywords"></textarea>
                <br><br>
                Relevant Image/Video
                <input type="file" accept="image/*, Video/*" name="relevant" required>
                <br><br>
                <input type="submit">
            </fieldset>
        </form>
    </center>
</body>

</html>
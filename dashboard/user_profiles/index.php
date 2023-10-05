<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>User Profiles</title>

</head>

<body>
    <?php
    include_once "../db_connect.inc";

    $connection = connect();

    session_start();

    // if go to URL of this page without login, then log out 
    if (!isset($_SESSION["email"]))
        header("location: ../../");

    $email = $_SESSION["email"];
    $query = "select * from user where email = '" . $email . "'";


    $result = $connection->query($query);

    $row = $result->fetch();

    $name = $row["name"];
    $photo_path = $row["photo_path"];
    $cv_path = $row["cv_path"];
    $experience = $row["experience"];
    $level_experience = $row["level_experience"];
    $bio = $row["bio"];
    $interest = $row["interest"];

    ?>
    <center>
        <h1>Update User Profile</h1>

        <?php
        if (isset($_GET["error"])) {
            $error = $_GET["error"];
            if ($error == 1)
                echo "<h3>can't load photo.</h3><br>";
            else if ($error == 2)
                echo "<h3>This photo is exist, try to change it's name.</h3><br>";
            else if ($error == 3)
                echo "<h3>can't load CV.</h3><br>";
            else if ($error == 4)
                echo "<h3>This CV is exist, try to change it's name.</h3><br>";
            else
                echo "<h3>Can't update.</h3><br>";
        }
        ?>

        <p>Here, You can update your profile, note that once you add profile photo and CV, you can't change it.</p>
        <form method="post" action="process.php" enctype="multipart/form-data">
            <fieldset style="width: 0;">
                Name:
                <br>
                <?php if (isset($name) && !empty($name))
                    echo "<input type='text' name='name' value='$name' required>";
                else
                    echo "<input type='text' name='name' required>";
                ?>

                <br><br>
                Profile Photo:
                <br>
                <?php if (isset($photo_path) && !empty($photo_path)) {
                    echo "<img width='200' src='../images/photos/" . $photo_path . "' alt='your profile photo'>";
                    echo "<input type='hidden' name='photo_path' value='" . $photo_path . "'>";
                } else
                    echo "<input type='file' accept='image/*' name='photo_path'>";
                ?>
                <br><br>
                Your CV:
                <br>
                <?php if (isset($cv_path) && !empty($cv_path)) {
                    echo "<a target='blank' href='../files/CVs/" . $cv_path . "'>URL</a>";
                    echo "<input type='hidden' name='cv_path' value='" . $cv_path . "'>";
                } else
                    echo "<input type='file' accept='.pdf' name='cv_path'>";
                ?>
                <br><br>
                Your Experience:
                <br>
                <?php if (isset($experience) && !empty($experience))
                    echo "<input type='text' name='experience' value='$experience'>";
                else
                    echo "<input type='text' name='experience'>";
                ?>
                <br><br>
                Level Of experience:
                <br>
                <?php if (isset($level_experience) && !empty($level_experience)) {
                    echo "<select name='level_experience'>";
                    if ($level_experience == 1)
                        echo "<option value='1' selected='true'>beginner</option>
                            <option value='2'>intermediate</option>
                            <option value='3'>advanced</option>
                            <option value='4'>expert</option>
                        </select>";
                    else if ($level_experience == 2)
                        echo "<option value='1'>beginner</option>
                            <option value='2' selected='true'>intermediate</option>
                            <option value='3'>advanced</option>
                            <option value='4'>expert</option>
                        </select>";
                    else if ($level_experience == 3)
                        echo "<option value='1'>beginner</option>
                            <option value='2'>intermediate</option>
                            <option value='3' selected='true'>advanced</option>
                            <option value='4'>expert</option>
                        </select>";
                    else if ($level_experience == 4)
                        echo "<option value='1'>beginner</option>
                            <option value='2'>intermediate</option>
                            <option value='3'>advanced</option>
                            <option value='4' selected='true'>expert</option>
                        </select>";
                    else
                        echo "<option value='1'>beginner</option>
                            <option value='2'>intermediate</option>
                            <option value='3'>advanced</option>
                            <option value='4' selected='true'>expert</option>
                        </select>";
                } else
                    echo "<select name='level_experience'>
                    <option value='1'>beginner</option>
                    <option value='2'>intermediate</option>
                    <option value='3'>advanced</option>
                    <option value='4'>expert</option>
                </select>";
                ?>

                <br><br>
                Brif bio:
                <br>
                <?php if (isset($bio) && !empty($bio))
                    echo "<textarea rows='6' name='bio'>$bio</textarea>";
                else
                    echo "<textarea rows='6' name='bio'></textarea>";
                ?>
                <br><br>
                Interest:
                <br>
                <?php if (isset($interest) && !empty($interest))
                    echo "<textarea rows='6' name='interest'>$interest</textarea>";
                else
                    echo "<textarea rows='6' name='interest'></textarea>";
                ?>
                <br>
                <input type="submit">
            </fieldset>
        </form>
        <br>
        <br>
    </center>
</body>

</html>
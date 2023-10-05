<?php
include_once "../db_connect.inc";


$connection = connect();

session_start();


$email = $_SESSION["email"];
$name = $_POST["name"];
$experience = $_POST["experience"];
if ($experience !== "")
    $level_experience = $_POST["level_experience"];
$bio = $_POST["bio"];
$interest = $_POST["interest"];

$photo_target_dir = "../images/photos/";
if (isset($_FILES["photo_path"])) {
    $photo_path = $_FILES["photo_path"]["name"];

    if (!empty($photo_path)) {
        $photo_file = $photo_target_dir . basename($_FILES["photo_path"]["name"]);

        // Check if file already exists
        if (!file_exists($photo_file)) {
            if (!move_uploaded_file($_FILES["photo_path"]["tmp_name"], $photo_file)) {
                header("location: index.php?error=1");
                return;
            }
        } else {
            header("location: index.php?error=2");
            return;
        }
    }
} else {
    // if the photo is loaded before to database then i will sent it in hidden and this to don't change it's value
    $photo_path = $_POST["photo_path"];
    $photo_file = $photo_target_dir . $photo_path;
}

$cv_target_dir = "../files/Cvs/";
if (isset($_FILES["cv_path"])) {
    $cv_path = $_FILES["cv_path"]["name"];

    if (!empty($cv_path)) {
        $cv_file = $cv_target_dir . basename($_FILES["cv_path"]["name"]);

        // Check if file already exists
        if (!file_exists($cv_file)) {
            if (!move_uploaded_file($_FILES["cv_path"]["tmp_name"], $cv_file))
                header("location: index.php?error=3");
        } else {
            header("location: index.php?error=4");
            return;
        }
    }   
} else {
    // if the CV is loaded before to database then i will sent it in hidden and this to don't change it's value

    $cv_path = $_POST["cv_path"];
    $cv_file = $cv_target_dir . $_POST["cv_path"];
}

$sql = "UPDATE `user` SET `name`= :name,`photo_path`= :photo_path,`bio`= :bio
,`cv_path`= :cv_path,`experience`= :experience,`level_experience`= :level_experience,`interest`= :interest WHERE email = '$email'";

// prepare statement
$statement = $connection->prepare($sql);

// bind params
$statement->bindParam(':name', $name);
$statement->bindParam(':photo_path', $photo_path);
$statement->bindParam(':bio', $bio);
$statement->bindParam(':cv_path', $cv_path);
$statement->bindParam(':experience', $experience);
$statement->bindParam(':level_experience', $level_experience, PDO::PARAM_INT);
$statement->bindParam(':interest', $interest);

try {
    if ($statement->execute())
        header("location: ../");
} catch (Exception $e) {
    header("location: index.php?error=5");
}

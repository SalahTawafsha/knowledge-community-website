<?php
include_once "../db_connect.inc";


$connection = connect();

session_start();

$user_email = $_SESSION["email"];
$title = $_POST["title"];
$description = $_POST["description"];
$keywords = $_POST["keywords"];
$relevant_file_name = $_FILES["relevant_file_name"]["name"];

$relevant_target_dir = "../files/file_sharing/";
$relevant_file = $relevant_target_dir . basename($_FILES["relevant_file_name"]["name"]);

// Check if file already exists
if (!file_exists($relevant_file)) {
    if (!move_uploaded_file($_FILES["relevant_file_name"]["tmp_name"], $relevant_file)) {
        header("location: index.php?error=1");
        return;
    }
} else {
    header("location: index.php?error=2");
    return;
}


$stm = $connection->prepare("INSERT INTO `files`(`user_email`, `title`, `description`, `keywords`, `relevant_file_name`) VALUES (?,?,?,?,?)");

try {
    $stm->execute([$user_email, $title, $description, $keywords, $relevant_file_name]);
    header("location: ../");
} catch (PDOException $e) {
    echo $e->getMessage();
    header("location: index.php?error=3");
}

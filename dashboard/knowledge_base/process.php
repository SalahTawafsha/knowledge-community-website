<?php
include_once "../db_connect.inc";


$connection = connect();

session_start();


$user_email = $_SESSION["email"];
$title = $_POST["title"];
$description = $_POST["description"];
$body_text = $_POST["body_text"];
$keywords = $_POST["keywords"];
$relevant_file_name = $_FILES["relevant"]["name"];

$relevant_target_dir = "../files/articles/";
$relevant_file = $relevant_target_dir . basename($_FILES["relevant"]["name"]);

// Check if file already exists
if (!file_exists($relevant_file)) {
    if (!move_uploaded_file($_FILES["relevant"]["tmp_name"], $relevant_file)) {
        header("location: index.php?error=2");
        return;
    }
} else {
    header("location: index.php?error=3");
    return;
}

$stm = $connection->prepare("INSERT INTO `article`(`user_email`, `title`, `description`, `body_text`, `keywords`, `relevant_file_name`) VALUES (?,?,?,?,?,?)");

try {
    $stm->execute([$user_email, $title, $description, $body_text, $keywords, $relevant_file_name]);
    header("location: ../");
} catch (PDOException $e) {
    echo $e->getMessage();
    header("location: index.php?error=1");
}

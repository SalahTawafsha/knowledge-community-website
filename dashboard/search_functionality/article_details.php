<?php

include_once "../db_connect.inc";

$connection = connect();

$title = $_GET["title"];

$query = "select * from article where title = '$title'";


$result = $connection->query($query);

$row = $result->fetch();
echo "<h1>" . $row['title'] . "</h1>";
echo "<h3>Discreption:</h3><p>" . $row['description'] . "</h3>";
echo "<h3>Body:</h3><p>" . $row['body_text'] . "</p>";
echo "<h3>Keywords:</h3><p>" . $row['keywords'] . "</p>";

// check kind of file to display it
$mime = mime_content_type("../files/articles/" . $row["relevant_file_name"]);
if (strstr($mime, "video/")) {
    echo "<h3>Video relevant</h3>";
    echo "<video controls width=\"800\" src=\"../files/articles/" . $row["relevant_file_name"] . "\"></video>";
} else if (strstr($mime, "image/")) {
    echo "<h3>Image relevant</h3>";
    echo "<img width=\"800\" src=\"../files/articles/" . $row["relevant_file_name"] . "\" alt=\"\">";
}

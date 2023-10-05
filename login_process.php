<?php
include_once "dashboard/db_connect.inc";

$connection = connect();

$query = "select password from user where email = '" . $_POST["email"] . "'";


$result = $connection->query($query);

$row = $result->fetch();

if ($row != null) {
    if ($_POST["password"] == $row["password"]) {
        session_start();

        $_SESSION["email"] = $_POST["email"];

        header("location: dashboard");
    } else
        header("location: index.php?error=1");
} else
    header("location: index.php?error=2");

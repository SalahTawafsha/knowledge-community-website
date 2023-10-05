<?php
include_once "dashboard/db_connect.inc";

if (strlen($_POST["password"]) >= 8) {
    $connection = connect();

    $stm = $connection->prepare("insert into user (email, password) values (?,?) ;");

    try {
        $stm->execute([$_POST["email"], $_POST["password"]]);
        header("location: index.php?msg=1");
    } catch (PDOException $e) {
        header("location: index.php?msg=2");
    }
} else {
    header("location: sign_up.php?error=1");
}

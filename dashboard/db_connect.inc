<?php
    function connect() {
        $host = "localhost";
        $dbname = "c75_web_community";
        $userName = "c75wb1200339";
        $password = "Node@2023";
        return new PDO("mysql:host=$host;dbname=$dbname;charset=UTF8", $userName, $password);
    }

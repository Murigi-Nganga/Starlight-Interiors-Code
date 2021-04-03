<?php

    $dbhost = "localhost";
    $dbuser = "root";
    $dbpassword = "";
    $dbname = "practice";

    $conn = mysqli_connect($dbhost, $dbuser, $dbpassword, $dbname);
    if(!$conn) {
        die("Connection failed: " . mysqli_error($conn));
    }
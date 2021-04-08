<?php

    $dbhost = "localhost";
    $dbuser = "root";
    $dbpassword = "";
    $dbname = "interior_design";

    $conn = mysqli_connect($dbhost, $dbuser, $dbpassword, $dbname);
    if(!$conn) {
        die("Connection failed: ". mysqli_connect_error());
    }


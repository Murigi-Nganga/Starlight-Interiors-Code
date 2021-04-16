<?php

    if (isset($_POST["login"])) {

        $emailorid = $_POST["emailorid"];
        $password = $_POST["password"];

        require_once "connection_inc.php";
        require_once "functions_inc.php";

        loginUser($conn, $emailorid, $password);

    } else {
        header("location: ../login.php");
        exit();
    }

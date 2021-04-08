<?php

    if (isset($_POST["login"])) {

        $emailorid = $_POST["emailorid"];
        $password = $_POST["password"];

        require_once "connection_inc.php";
        require_once "functions_inc.php";

        if (emptyLoginInput($emailorid, $password) !== false) {
            header("location: ../login.php?error=emptyinput");
            exit();
        }

        loginUser($conn, $emailorid, $password);

    } else {
        header("location: ../login.php");
        exit();
    }

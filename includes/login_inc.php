<?php

    if (isset($_POST["login"])) {

        $emailorid = $_POST["emailorid"];
        $password = $_POST["password"];
        $role = $_POST["role"];

        require_once "connection_inc.php";
        require_once "functions_inc.php";

        if($role === 'client') {
            loginUser($conn, $emailorid, $password);
        } elseif ($role === 'designer') {
            loginDesigner($conn, $emailorid, $password);
        } elseif ($role === 'admin') {
            loginAdmin($conn, $emailorid, $password);
        }
        

    } else {
        header("location: ../login.php");
        exit();
    }

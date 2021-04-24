<?php
        require_once "connection_inc.php";
        require_once "functions_inc.php";

        $clientID = $_POST["clientID"];
        $designerID = $_POST["designerID"];
        $requirementsID = $_POST["rqID"];
        $today = date("Y-m-d H:i:s");
        assignClient($conn, $clientID, $designerID, $today, $requirementsID);

        header("location: ../php/requirements.php?error=none");
        exit();
<?php
    session_start();
    if (isset($_POST["confirmcomplete"])) {
        require_once "connection_inc.php";
        require_once "functions_inc.php";

        $today = date("Y-m-d H:i:s");
        $clientID = $_POST["clientID"];
        $requirementsID = $_POST["requirementsID"];

        $drawings = getDrawingsNumber($conn, $clientID);

        if($drawings > 0) {   //Only mark the work as completed if there are drawings
            completeWork($conn, $requirementsID, $clientID, $today);
        } else {
            header("location: ../php/progress.php?error=nodrawing");
            exit();
        }
    } else {
        header("location: ../php/progress.php");
        exit();
    }
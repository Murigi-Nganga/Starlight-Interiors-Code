<?php
    session_start();

    if (isset($_POST["submit-pay"])) {
        require_once "connection_inc.php";
        require_once "functions_inc.php";

        $amountPaid = $_POST["amountPaid"];
        $paymentPlatform = $_POST["paymentPlatform"];
        $paymentPurpose = $_POST["paymentPurpose"];
        $today = date("Y-m-d H:i:s");
        $clientID = $_SESSION["userID"];
        

        if($adminRow = adminExists($conn, 38383838, 38383838)) {        //Query admin's data instead  //Explizit geschrieben
            $message = "Client with ID ".$clientID." has submitted their payment details";
            $notificationTag = "payments";
            pushNotification($conn, $adminRow['AdminID'], $message, $notificationTag, $today);            
        }
        //Was hinzufuegen, um einen der Admins von einer Liste zu waehlen
        submitPayment($conn, $clientID, $amountPaid, $paymentPlatform, $paymentPurpose, $today);

    } elseif (isset($_POST['confirm'])) {                       //Show notification to the user that their payment has been confirmed
        require_once "connection_inc.php";
        require_once "functions_inc.php";
        $clientID = $_POST["clientID"];
        $paymentID = $_POST["paymentID"];
        
        $today = date("Y-m-d H:i:s");

        confirmPayment($conn, $clientID, $paymentID, $today);       //Confirms and pushes notifications

    } else {

        header("location: ../php/payments.php");
        exit();
        
    }


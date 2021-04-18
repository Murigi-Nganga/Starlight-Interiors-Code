<?php
    session_start();

        require_once "../includes/connection_inc.php";
        require_once "../includes/functions_inc.php";

    // if(isset($_SESSION["AdminID"]) || isset($_SESSION["ClientID"]) || isset($_SESSION["DesignerID"]))
    if(isset($_SESSION["role"])) {
        
        $sql = "SELECT Message FROM notifications WHERE ReceiverID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$_SESSION["userID"]]);
        $resultData = $stmt->fetchAll();
        foreach ($resultData as $row) {
            echo $row["Message"];
        }
    }

    //print_r($_SESSION);    -To see all session details

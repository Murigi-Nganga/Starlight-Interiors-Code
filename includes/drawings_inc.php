<?php
    session_start();
    require_once "connection_inc.php";
    require_once "functions_inc.php";
    if (isset($_POST["submit-drawing"])) {

        $clientID = $_POST["clientID"];
        $drawingDescription = $_POST["drawingDescrip"];    //To add submission date implicitly
        $drawingPrice = $_POST["drawingprice"];

        //File Input
        $drawingPic = $_FILES["drawingpic"];
        $drawingPicName = $drawingPic["name"];
        $drawingPicExt = strtolower(pathinfo($drawingPicName, PATHINFO_EXTENSION));
        $drawingPicTmpName = $drawingPic['tmp_name'];
        $drawingPicSize = $drawingPic['size'];
        $drawingPicError = $drawingPic['error'];
        $drawingPicType = $drawingPic['type'];
        $newDrawingPicName = uniqid('IMG-', true).".".$drawingPicExt;
        $drawingPicDestination = "../uploads/drawings/".$newDrawingPicName;

        $designerID = $_SESSION["userID"];
        $today = date("Y-m-d H:i:s");

        if ($drawingPicError === 0) {
            if ($drawingPicSize > 5000000) {
                header("location: ../php/drawings.php?error=filesizetoobig");
                exit();   
            } else {
                //First check to see if the designer has been assigned to that specific client
                if(dsnHasThisClient($conn, $clientID, $designerID)===true) { 

                    move_uploaded_file($drawingPicTmpName, $drawingPicDestination);
                    createDrawing($conn, $designerID, $drawingPicDestination, $drawingDescription,$drawingPrice, $today, $clientID);

                } elseif(dsnHasThisClient($conn, $clientID, $designerID)===false) {
                    header("location: ../php/drawings.php?error=notassignedtoclient");
                    exit();        
                }

            } 
        }  else {
                header("Location: ../php/drawings.php?error=erroruploadingfile");
                exit();                      
         }
    } elseif(isset($_POST["submitRemarks"])) {

        $remarks = $_POST["remarks"];
        $drawingID = $_POST["drawingID"];
        addRemarks($conn, $drawingID, $remarks);

    } elseif(isset($_POST["gwdesign"])){
        $drawingID = $_POST["drawID"];
        $amount = getDrawingPrice($conn, $drawingID);
        header("location: ../php/payments.php?amount=".$amount);
        exit();
    }else {
        header("location: ../php/drawings.php");
        exit();

    }
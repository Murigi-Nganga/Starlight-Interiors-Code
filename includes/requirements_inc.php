<?php
    session_start();
    if (isset($_POST["submit-req"])) {
        require_once "connection_inc.php";
        require_once "functions_inc.php";

        $typeOfRoom = $_POST["typeofroom"];
        $approxSize = $_POST["approxsize"];
        $colors = $_POST["colors"];
        $disColors = $_POST["discolors"];
        $floorType= $_POST["floortype"];
        $wallCovering = $_POST["wallcovering"];
        $specialNeeds = $_POST["specialneeds"];
        $budget = $_POST["budget"];
        $anyOtherInfo = $_POST["anyotherinfo"];    //To add submission date and client ID implicitly

        //File Inputs
        $roomPic = $_FILES["roompic"];
        $roomPicName = $roomPic["name"];
        $roomPicExt = strtolower(pathinfo($roomPicName, PATHINFO_EXTENSION));
        $roomPicTmpName = $roomPic['tmp_name'];
        $roomPicSize = $roomPic['size'];
        $roomPicError = $roomPic['error'];
        $roomPicType = $roomPic['type'];
        $newRoomPicName = uniqid('IMG-', true).".".$roomPicExt;
        $roomPicDestination = "../uploads/requirements/".$newRoomPicName;

        $inspoPic = $_FILES["inspopic"];
        $inspoPicName = $inspoPic["name"];
        $inspoPicExt = strtolower(pathinfo($inspoPicName, PATHINFO_EXTENSION));
        $inspoPicTmpName = $inspoPic['tmp_name'];
        $inspoPicSize = $inspoPic['size'];
        $inspoPicError = $inspoPic['error'];
        $InspoPicType = $inspoPic['type'];
        $newInspoPicName = uniqid('IMG-', true).".".$inspoPicExt;
        $inspoPicDestination = "../uploads/requirements/".$newInspoPicName;


        $today = date("Y-m-d H:i:s");
        $clientID = $_SESSION["userID"];

        if ($inspoPicError === 0 && $roomPicError === 0) {
            if ($roomPicSize > 5000000 || $inspoPicSize > 5000000) {
                header("Location: ../php/requirements.php?error=filesizetoobig");
                exit();   
            } else {
                move_uploaded_file($roomPicTmpName, $roomPicDestination);
                move_uploaded_file($inspoPicTmpName, $inspoPicDestination);

                if($adminRow = adminExists($conn, 38383838, 38383838)) {
                    $message = "Client with ID ".$clientID." has submitted a requirements specification";
                    $notificationTag = "requirements";
                    pushNotification($conn, $adminRow['AdminID'], $message, $notificationTag, $today);            
                }

                createRequirement($conn,$clientID,$typeOfRoom,$roomPicDestination,$approxSize,$colors, 
                $disColors, $floorType, $wallCovering, $inspoPicDestination, $specialNeeds, $budget, $anyOtherInfo, $today);
            } 
        }  else {
                header("Location: ../php/requirements.php?error=erroruploadingfile");
                exit();                      
         }
    } else {
        header("location: ../php/requirements.php");
        exit();
    }

    
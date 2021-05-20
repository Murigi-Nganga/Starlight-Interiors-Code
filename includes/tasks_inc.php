<?php
session_start();
    require_once "connection_inc.php";
    require_once "functions_inc.php";

    $designerID = $_SESSION["userID"];
    $taskID = $_POST["taskid"];

    if(isset($_POST["addtask"])){
        $today =date("Y-m-d H:i:s");
        $taskMessage = $_POST["taskmsg"];
        createTask($conn, $designerID, $taskMessage, $today);
    } elseif(isset($_POST["delete"])) {
        deleteTask($conn, $designerID, $taskID);
    } elseif(isset($_POST["mark"])) {
        completedTask($conn, $designerID, $taskID);
    } 
    
    
    

    

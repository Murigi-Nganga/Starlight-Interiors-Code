<?php
    require_once "connection_inc.php";
    session_start();

    //On logging out, delete all notifications read by the user .....
    $sql = "DELETE FROM notifications WHERE ReceiverID = ? AND status = ?;";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$_SESSION["userID"], 'read']);

    session_unset();
    session_destroy();

    header("location: ../php/index.php");
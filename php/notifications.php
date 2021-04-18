<?
session_start();

    require_once "connection.php";
    $sql = "SELECT FROM notifications WHERE ReceiverID = ?";
    $conn->prepare($sql);
    $conn->execute();

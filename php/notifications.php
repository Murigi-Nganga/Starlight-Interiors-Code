<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifications</title>
    <link rel="stylesheet" href="../css/notifications.css">
    <script defer src="../js/notifications.js"></script>
</head>
<body>
<nav id= "nav">
                <div class="logo">
                    <img src="../images/logo.png" alt="Image of a camel">
                </div>
                <div class="coname">
                    Starlight Interiors
                </div>
                <ul>
                    <li><a href="../php/notifications.php"style="color:peru"><img src="../images/MessagesBell.png" alt="No messages Notification Bell"></a></li>
                    <li><a href="../php/index.php">Home</a></li>
                    <li><a href="../php/requirements.php">Requirements</a></li>
                    <li><a href="../php/drawings.php" >Drawings</a></li>
                    <li><a href="../php/tasks.php" >Payments</a></li>
                    <li><a href="../includes/logout_inc.php">Log Out</a></li>
                </ul>
            </nav>
<?php
    session_start();

        require_once "../includes/connection_inc.php";
        require_once "../includes/functions_inc.php";

    // if(isset($_SESSION["AdminID"]) || isset($_SESSION["ClientID"]) || isset($_SESSION["DesignerID"]))    -->Rolle hinzufuegen
    if(isset($_SESSION["role"])) {
        $sql = "SELECT Message FROM notifications WHERE ReceiverID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$_SESSION["userID"]]);
        if($stmt->rowCount() > 0) {
            echo '<div class="container">';
            while($row = $stmt->fetch()) {

                echo '<div class="message">'.$row["Message"].'</div>';

            }
            echo '</div>';
        } else {
            echo "You have no notifications!";
        }
    }   //print_r($_SESSION);    -To see all session details
?>

</body>
</html>

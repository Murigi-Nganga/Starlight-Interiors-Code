<!DOCTYPE html>
    <html lang="en">
        <body>
<?php
session_start();
require_once "../includes/connection_inc.php";
require_once "../includes/functions_inc.php";

if ($_SESSION["role"] === 'client') {
    include "client_req.php";

} elseif ($_SESSION["role"] === 'admin') {  //If it is the admin, then query the data ..... 
    $sql = "SELECT * FROM requirements WHERE AssignedDesigner IS NULL";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        header("location: ../php/requirements.php?error=stmtfailed");
        exit();
    } 
    if(isset($_GET['error'])) {
        if($_GET['error'] === 'dsndoesntexist'){
            echo '<script>alert("A designer with that ID doesn\'t exist!")</script>';
        } elseif ($_GET['error'] === 'none') {
            echo '<script>alert("Assignment done successfully!")</script>';
        }
    }

   echo '<head>'.
        '<meta charset="UTF-8">'.
        '<meta http-equiv="X-UA-Compatible" content="IE=edge">'.
        '<meta name="viewport" content="width=device-width, initial-scale=1.0">'.
        '<title>Admin Side Requirements</title>'.
        '<link rel="stylesheet" href="../css/unassigned.css">'.
        '<script defer src="../js/unassigned.js" text="text/javascript"></script>'.
    '</head>'.
    '<nav id= "nav">'.
        '<div class="logo">'.
            '<img src="../images/logo.png" alt="Image of a camel">'.
        '</div>'.
        '<div class="coname">'.
            'Starlight Interiors'.
        '</div>'.
        '<ul>'.
        '<li><a href="../php/notifications.php"style="color:peru"><img src="../images/MessagesBell.png" alt="No messages Notification Bell"></a></li>'.
            '<li><a href="../php/index.php">Home</a></li>'.
            '<li><a href="../php/requirements.php" style="color:peru">Requirements</a></li>'.
            '<li><a href="../php/progress.php">Progress</a></li>'.
            '<li><a href="../php/payments.php">Payments</a></li>'.
            '<li><a href="../includes/logout_inc.php">Log Out</a></li>'.
        '</ul>'.
    '</nav>'.
    '<div id=show></div>'.
    '<body>';
    $stmt->execute();

    $formIndex = 0;
    echo '<div class ="reqscontainer">';
    while ($row = $stmt->fetch()) {
        echo '<div class ="req">' .
            '<div class ="circle">' .
            '<p>ID: ' . $row["RequirementsID"] . '</p>' .
            '</div>' .
            '<div class="content">' .
                '<p><span>Client ID: </span>' . $row["ClientID"] . '</p>' .
                '<p><span>Type of Room: </span>' . $row["RoomType"] . '</p>' .
                '<p><span>Size of Room: </span>' . $row["RoomSize"] . '</p>' .
                '<p><span>Favorite Colors: </span>' . $row["FavColors"] . '</p>' .
                '<p><span>Disliked Colors: </span>' . $row["DisColors"] . '</p>' .
                '<p><span>Type of Floor: </span>' . $row["FloorType"] . '</p>' .
                '<p><span>Type of Wall: </span>' . $row["WallType"] . '</p>' .
                '<p><span>Special Needs: </span>' . $row["SpecialNeeds"] . '</p>' .
                '<p><span>Budget Amount: </span>' . $row["Budget"] . '</p>' .
                '<p><span>Other Information: </span>' . $row["AnyOtherInfo"] . '</p>' .
                '<p><span>Submission Date: </span>' . $row["SubmissionDate"] . '</p> <br>';
                $clientRow = getUserDetails($conn, 'clients', $row["ClientID"], 'ClientID');
                echo '<p><span>Client\'s Name: </span>' . $clientRow["FirstName"] . ' ' . $clientRow["SecondName"] .
                '<p><span>Location: </span>' . $clientRow["Location"] . '</p>' .
                '<button onclick="displayForm('.$formIndex.')">Do Assignment</button>'.
            '</div>' .
            '</div>' .
            '<div class="reqimages">' .
            '<p>Room Picture</p>' .
            '<img src="' . $row["RoomPicture"] . '" alt="Room Picture">' .
            '</div>' .
            '<div class="reqimages">' .
            '<p>Inspiration Picture</p>' .
            '<img src="' . $row["InspoPic"] . '" alt="Room Picture">' .
            '</div>' .
            '<div id="formelement">' .
            '<form id="assignForm" method="POST" action="../includes/assign_inc.php">' .
            '<label for="clientID">Client\'s ID: </label>' .
            '<input id="clientID" type="text" name="clientID" value="' . $row["ClientID"] .'"> <br>' .
            '<label for="designerID">Designer\'s Email or ID: </label>' .
            '<input id="designerID" type="text" name="designerID" > <br>' .
            '<input id="rqID" type="number" name="rqID" value="' . $row["RequirementsID"] .'"> <br>' .
            '<button id="submitassign" name="submitassign" type="submit">Submit</button>' .
            '</form>' .
            '</div>';
            $formIndex++;
    }
    echo '</div>';
} elseif ($_SESSION["role"] === 'designer') {
echo '<link rel="stylesheet" href="../css/unassigned.css">
        <script defer src="../js/requirements.js"></script>'. 
'<nav id= "nav">'.
    '<div class="logo">'.
        '<img src="../images/logo.png" alt="Image of a camel">'.
    '</div>'.
    '<div class="coname">'.
        'Starlight Interiors'.
    '</div>'.
    '<ul>'.
        '<li><a href="../php/index.php">Home</a></li>'.
        '<li><a href="../php/requirements.php" style="color:peru">Requirements</a></li>'.
        '<li><a href="../php/drawings.php">Drawings</a></li>'.
        '<li><a href="../php/tasks.php">Tasks</a></li>'.
        '<li><a href="../includes/logout_inc.php">Log Out</a></li>'.
    '</ul>'.
'</nav>';

$sql = "SELECT * FROM requirements WHERE  AssignedDesigner = ?";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    header("location: ../php/requirements.php?error=stmtfailed");
    exit();
} 
echo 
$stmt->execute([$_SESSION["userID"]]);                                                                    //Default Status -> NULL
$formIndex = 0;
    echo '<div class ="reqscontainer">';
    while ($row = $stmt->fetch()) {
        echo '<div class ="req">' .
            '<div class ="circle">' .
            '<p>ID: ' . $row["RequirementsID"] . '</p>' .
            '</div>' .
            '<div class="content">' .
                '<p><span>Client ID: </span>' . $row["ClientID"] . '</p>' .
                '<p><span>Type of Room: </span>' . $row["RoomType"] . '</p>' .
                '<p><span>Size of Room: </span>' . $row["RoomSize"] . '</p>' .
                '<p><span>Favorite Colors: </span>' . $row["FavColors"] . '</p>' .
                '<p><span>Disliked Colors: </span>' . $row["DisColors"] . '</p>' .
                '<p><span>Type of Floor: </span>' . $row["FloorType"] . '</p>' .
                '<p><span>Type of Wall: </span>' . $row["WallType"] . '</p>' .
                '<p><span>Special Needs: </span>' . $row["SpecialNeeds"] . '</p>' .
                '<p><span>Budget Amount: </span>' . $row["Budget"] . '</p>' .
                '<p><span>Other Information: </span>' . $row["AnyOtherInfo"] . '</p>' .
                '<p><span>Submission Date: </span>' . $row["SubmissionDate"] . '</p> <br>';
                $clientRow = getUserDetails($conn, 'clients', $row["ClientID"], 'ClientID');
                echo '<p><span>Client\'s Name: </span>' . $clientRow["FirstName"] . ' ' . $clientRow["SecondName"].
                '<p><span>Location: </span>' . $clientRow["Location"] . '</p>' .
            '</div>' .
            '</div>' .
            '<div class="reqimages">' .
            '<p>Room Picture</p>' .
            '<img src="' . $row["RoomPicture"] . '" alt="Room Picture">' .
            '</div>' .
            '<div class="reqimages">' .
            '<p>Inspiration Picture</p>' .
            '<img src="' . $row["InspoPic"] . '" alt="Room Picture">' .
            '</div>';
            $formIndex++;
    }
    echo '</div>';


} else {
    header("location: ../php/login.php");
    exit();
}
    ?>
    </body>

    </html>
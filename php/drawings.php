<?php
    session_start();
    require_once "../includes/connection_inc.php";
    if($_SESSION["role"] === 'client') {
?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/drawings.css">
    <script defer src="../js/drawings.js"></script>
    <title>Interior Design Management System</title>
</head>
<body>
    <nav id= 'nav'>
        <div class="logo">
            <img src="../images/logo.png" alt="Image of a camel">
        </div>
        <div class="coname">
            Starlight Interiors
        </div>
        <ul>
            <li><a href="../php/notifications.php"><img src="../images/MessagesBell.png" alt="No messages Notification Bell"></a></li>
            <li><a href="../php/index.php">Home</a></li>
            <li><a href="../php/requirements.php">Requirements</a></li>
            <li><a href="../php/drawings.php" style="color:peru">Drawings</a></li>
            <li><a href="../php/payments.php">Payments</a></li>
            <li><a href="../includes/logout_inc.php">Log Out</a></li>
        </ul>
    </nav>
        <?php
        require_once "../includes/connection_inc.php";
        echo '<link rel="stylesheet" href="../css/drawings.css">';

        $sql = "SELECT * FROM drawings WHERE ClientID = ? AND DrawingStatus = ?";
        $stmt = $conn->prepare($sql);

        if(!$stmt) {
            header("location: ../php/drawings.php?error=stmtfailed"); 
            exit();
        }

        $stmt->execute([$_SESSION["userID"], 'unapproved']);
            $index = 0;
        if($stmt->rowCount() > 0){ 
            echo '<div id="drawing-items">';
        while($row = $stmt->fetch()){
            echo '
            <div id="drawing-item">
            <img id="drawingpic" src="'.$row["DrawingPic"].'">
            </div>
            <div class="details-box" id="drawing-item">';
            echo 'Description: '.$row["DrawingDescription"].'<br>';
            echo 'Submission Date: '.$row["SubmissionDate"].'<br>';
            echo 'Drawing Price: '.$row["DrawingPrice"];
            echo '
                <form id="remarksform" action="../includes/drawings_inc.php" method="POST">
                    <input type="number" name="drawingID" id="drawingID" value="'.$row["DrawingID"].'">
                    <textarea id="remarks" name="remarks" rows="3" cols="40" placeholder="Write your suggestions here and click on suggest changes"></textarea>
                    <input type="submit" name="submitRemarks" id="submitRemarks" value="Suggest Changes" onclick=checkRemarks('.$index.')>
                </form>
                <form id="gwform" action ="../includes/drawings_inc.php" method="Post">
                    <input type="submit" name="gwdesign" id="gwdesign" value="Go with design">
                    <input type="number" name="drawid" id="drawid" value='.$row["DrawingID"].'
                </form>
            </div>
            ';
            $index++;
        }
        echo '            
        </div>';
    } else {
        echo '<h3 id="nodraw">You do not have any drawings yet!</h3>';
    }
        
        echo '</body>
        </html>';

    } elseif($_SESSION["role"] === 'designer') {
        //Drawing ID, DesignerID, Drawing Pic, Drawing Description, Submission date, Drawing status, Client ID
        echo ' <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="../css/drawings.css">
            <script defer src="../js/drawings.js"></script>
            <title>Interior Design Management System</title>
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
                    <li><a href="../php/index.php">Home</a></li>
                    <li><a href="../php/requirements.php">Requirements</a></li>
                    <li><a href="../php/drawings.php" style="color:peru">Drawings</a></li>
                    <li><a href="../php/tasks.php">Tasks</a></li>
                    <li><a href="../includes/logout_inc.php">Log Out</a></li>
                </ul>
            </nav>
        <div id="display-errors"></div>';
        if(isset($_GET['error'])) {
            if($_GET['error'] === 'erroruploadingfile'){
                echo '<script>alert("Please fill in all inputs!")</script>';
            } elseif ($_GET['error'] === 'none') {
                echo '<script>alert("Your drawings has been submitted successfully!")</script>';
            }
        }

        $query = "SELECT * FROM drawings WHERE DesignerID = ? AND DrawingStatus = ?";
        $stm = $conn->prepare($query);
        if(!$stm) {
            header("location: ../php/drawings.php?error=stmtfailed"); 
            exit();
        }
        $stm->execute([$_SESSION["userID"], 'unapproved']);

        if($stm->rowCount() > 0) {
            echo '<div id="drdetails">';
            while($row = $stm->fetch()) {
                echo '<div id="drdetail">';
                echo 'Client\'s ID: '.$row["ClientID"].'<br>';
                echo 'Drawing ID: '.$row["DrawingID"].'<br>';
                echo 'Drawing Desription: '.$row["DrawingDescription"].'<br>';
                echo 'Drawing Status: '.$row["DrawingStatus"].'<br>';
                echo 'Client\'s Remarks: '.$row["ClientsRemarks"].'<br>';
                echo '</div>';
            }
            echo "</div>";
        }

    echo '<div class="formarea">
        <h1 style="text-align: center; font-weight:bolder; font-size:21px; text-decoration:underline;">Drawings</h1>
        <br><br>

    <form id="drawingform" name="drawingform"  action="../includes/drawings_inc.php" method="POST" enctype="multipart/form-data">
        <label for="clientID">1. Enter the id number or email of your client: </label> <br>
		<input id="clientID" type="text" name="clientID" > <br>

        <label for="drawingpic">2. Upload a picture of the drawing: </label> <br>
		<input id="drawingpic" type="file" name="drawingpic" > <br>

        <label for="drawingprice">3. Proposed price for the drawing: </label> <br>
		<input id="drawingprice" type="number" name="drawingprice" > <br>
		
        <label for="drawingDescrip">4. Give details about the drawing </label><br> 
		<textarea id="drawingDescrip" name="drawingDescrip" rows="3" cols="40"></textarea><br> <br>

        <button id="submit-drawing" name="submit-drawing" type="submit">Submit Drawing</button>
    </form>
    </div>
    </body>
    <html>';
    } elseif($_SESSION["role"] === 'admin') {
        require_once "../includes/connection_inc.php";
        $sql = "SELECT * FROM drawings";
        $stmt = $conn->prepare($sql);

        if(!$stmt) {
            header("location: ../php/drawings.php?error=stmtfailed"); 
            exit();
        }

        $stmt->execute();

        while($row = $stmt->fetch()){
            echo $row["DrawingDescription"];
        }
    }
?>

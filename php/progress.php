<!--Where the administrator can see the progress of the work amongst all designers and clients-->
<?php 
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/tables.css">
    <script defer src="../js/payments.js"></script>
    <title>Designer's Tasks</title>
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
                    <li><a href="../php/progress.php" style="color:peru">Progress</a></li>
                    <li><a href="../php/payments.php" >Payments</a></li>
                    <li><a href="../includes/logout_inc.php">Log Out</a></li>
                </ul>
            </nav>
<?php 
        if(isset($_GET['error'])) {
            if($_GET['error'] === 'none') {
                echo '<script>alert("Confirmation of your work has been done successfully!")</script>';
            }
        }
    require_once "../includes/connection_inc.php";
    $sql = "SELECT RequirementsID, DesignerID, ClientID, AssignmentDate FROM assignments WHERE CompletionDate IS NOT NULL";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        header("location: ../php/progress.php?error=stmtfailed");
        exit();
    } 
    $stmt->execute();

    if($stmt->rowCount() > 0) {
        echo '<table>';
        while($row = $stmt->fetch()) {
            echo '    
            <tr>
                <th>Requirements ID</th>
                <th>Designer ID</th>
                <th>Client ID</th>
                <th>Asignment Date</th>
                <th>Confirm Work Completeion</th>
            </tr>
            <tr>
                <td>'.$row["RequirementsID"].'</td>
                <td>'.$row["DesignerID"].'</td>
                <td>'.$row["ClientID"].'</td>
                <td>'.$row["AssignmentDate"].'</td>
                <td>
                    <form action="../includes/progress_inc.php" method="POST">
                        <div id="invisible">
                            <input type="number" name="requirementsID" id="requirementsID" value="'.$row["RequirementsID"].'">
                            <input type="number" name="clientID" id="clientID" value="'.$row["ClientID"].'">
                        </div>
                        <button id="confirmcomplete" name="confirmcomplete">Confirm</button>
                    </form>
                </td>
            </tr>';
        }
        echo'</table>';
    } else {
        echo "<h1>There is no work in progress!</h1>";
    }
?>
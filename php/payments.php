<?php
    session_start();
    require_once "../includes/connection_inc.php";
    if($_SESSION["role"] === 'client') {
        include_once "../html/payments.html";
    } elseif($_SESSION["role"] === 'admin') {
        echo '<!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="../css/tables.css">
            <script defer src="../js/payments.js"></script>
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
                    <li><a href="../php/drawings.php">Drawings</a></li>
                    <li><a href="../php/payments.php" style="color:coral">Payments</a></li>
                    <li><a href="../includes/logout_inc.php">Log Out</a></li>
                </ul>
            </nav>';

        $result = $conn->query("SELECT * FROM payments WHERE PaymentStatus = 'pending';");
        $rows = $result->fetchAll();
        
        if(count($rows) > 0){
            echo " 
            <table>
                <tr>
                    <th>Payment ID</th>
                    <th>Client ID</th>
                    <th>Amount Paid</th>
                    <th>Payment Platform</th>
                    <th>Payment Purpose</th>
                    <th>Submission Date</th>
                    <th>Confirm Payment</th>
                </tr>    
            ";
            foreach($rows as $row){
                echo '
                <tr>
                    <td>'.$row['PaymentID'].'</td>
                    <td>'.$row['ClientID'].'</td>
                    <td>'.$row['AmountPaid'].'</td>
                    <td>'.$row['PaymentPlatform'].'</td>
                    <td>'.$row['PaymentPurpose'].'</td>
                    <td>'.$row['SubmissionDate'].'</td>
                    <td>
                        <form action="../includes/payments_inc.php"  method="POST">
                            <div id = "invisible">
                                <input id="paymentID" type="number" name="paymentID" value="'.$row['PaymentID'].'">
                                <input id="clientID" type="number" name="clientID" value="'.$row['ClientID'].'">
                            </div>
                                <input id="confirm" type="submit" name="confirm" value="Confirm">
                        </form>
                    </td>
                </tr>
                ';
            }
            echo '</table>
            </body>
            </html>';
        } else {
            echo "<h3>There are no pending payments!</h3>";
        }
    }
?>
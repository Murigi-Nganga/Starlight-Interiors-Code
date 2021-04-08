<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/header.css">
    <script defer src="js/script.js" type="text/javascript"></script>
    <title>Interior Design Management System</title>
</head>
<body>
  <div class="container">
    <nav>
        <div class="logo">
            <img src="img/logo.png" alt="Image of a camel">
        </div>
        <ul>
            <li><a href="index.php">Home</a></li>
            <?php
                if (isset($_SESSION["userId"])) {
                    echo '<li><a href="requirements.php">Requirements</a></li>';
                    echo '<li><a href="drawings.php">Drawings</a></li>';
                    echo '<li><a href="payments.php">Payments</a></li>';
                    echo '<li><a href="includes/logout_inc.php">Log Out</a></li>';
                    } else {
                        echo '<li><a href="about.php">About</a></li>';
                        echo '<li><a href="services.php">Contact</a></li>';
                        echo '<li><a href="signup.php">Sign Up</a></li>';
                        echo '<li><a href="login.php">Log In</a></li>';
                    }
           ?>
        </ul>
    </nav>

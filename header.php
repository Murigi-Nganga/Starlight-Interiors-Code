<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Interior Design Management System</title>
</head>
<body>
      <div class="overlay">
            <nav>
            <div class="logo">
                <h4>The Nav</h4>
            </div>
                <ul class="nav-links">
                    <li><a href="index.php">Home</a></li>

                    <?php
                        if (isset($_SESSION["userId"])) {
                            echo '<li><a href="requirements.php">Requirements</a></li>';
                            echo '<li><a href="drawings.php">Drawings</a></li>';
                            echo '<li><a href="payments.php">Payments</a></li>';
                            echo '<li><a href="includes/logout_inc.php">Log Out</a></li>';
                        } else {
                            echo '<li><a href="about.php">About Us</a></li>';
                            echo '<li><a href="portfolio.php">Portfolio</a></li>';
                            echo '<li><a href="signup.php">Sign Up</a></li>';
                            echo '<li><a href="login.php">Log In</a></li>';
                        }
                    ?>

                </ul>
            </nav>
        </div>
</body>
</html>

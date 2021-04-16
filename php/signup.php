<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/login.css">
    <script defer src="../js/validate.js" type="text/javascript"></script>
    <title>Interior Design Management System</title>
</head>
<body>
  <div class="container">
    <nav id='nav'>
        <div class="logo">
            <img src="../images/logo.png" alt="Image of a camel">
        </div>
        <div class="coname">
            Starlight Interiors
        </div>
        <ul>
            <li><a href="index.php">Home</a></li>
            <?php
                if (isset($_SESSION["IdNumber"])) {
                    echo '<li><a href="requirements.php">Requirements</a></li>';
                    echo '<li><a href="drawings.php">Drawings</a></li>';
                    echo '<li><a href="payments.php">Payments</a></li>';
                    echo '<li><a href="includes/logout_inc.php">Log Out</a></li>';
                    } else {
                        echo '<li><a href="about.php">About</a></li>';
                        echo '<li><a href="services.php">Contact</a></li>';
                        echo '<li><a href="login.php">Log In</a></li>';
                        echo '<li><a href="signup.php">Sign Up</a></li>';
                    }
           ?>
        </ul>
    </nav>
  <!-- End Header -->
  
  <?php
    
    if(isset($_GET['error'])) {
        echo '<div id="display-db-errors">';
        echo '<p id="closebutton" onclick="deletedbDiv()">X</p>';
        if($_GET['error'] === 'emailoridtaken') {
            echo "<p>A user with that email or ID exists</p>";
        }
        echo '</div>';
  } 
  ?>
  <div id="display-errors"></div>
      <div class="form-box">
          <p>Sign Up</p>
<form id="register" class="input-group" method="POST" action="../includes/signup_inc.php" >
    <input id="idNumber" name="idNumber" type="text" class="input-field" placeholder="ID Number">
    <input id="firstName"name="firstName" type="text" class="input-field" placeholder="First Name">
    <input id="secondName"name="secondName" type="text" class="input-field" placeholder="Second Name">
    <input id="email"name="email" type="text" class="input-field" placeholder="Email Address">
    <input id="phoneNo"name="phoneNo" type="text" class="input-field" placeholder="Phone Number">
    <input id="location"name="location" type="text" class="input-field" placeholder="Location">
    <input id="password1"name="password1" type="password" class="input-field" placeholder="Password">
    <input id="password2"name="password2"type="password" class="input-field" placeholder="Re-enter password"> <br> <br> <br>
    <button id="signup"name="signup" type="submit" class="submit-btn">Sign Up</button>
</form>
</div>
</body>
</html>

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
  <!-- <video autoplay muted loop id="myVideo">
  <source src="../images/pexels-ekaterina-bolovtsova-5390907.mp4" type="video/mp4">
</video> -->
    <nav id='nav'>
        <div class="logo">
            <img src="../images/logo.png" alt="Image of a camel">
        </div>
        <div class="coname">
            Starlight Interiors
        </div>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="services.php">Contact</a></li>
            <li><a href="login.php">Log In</a></li>
            <li><a href="signup.php">Sign Up</a></li>
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
        <div class="slider-area"> 
    <div id="btn"></div>
        <button type="button" class="slider-btns" onclick="clientSignUp()">Client </button>
        <button id="btn2" type="button" class="slider-btns" onclick="designerSignUp()">Designer</button>
    </div>
<form id="register" class="input-group" method="POST" action="../includes/signup_inc.php" >
    <br>
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
<form id="designer-register" class="input-group" method="POST" action="../includes/signup_inc.php">
        <div id="designerinputs">
        <input id="idNumberdsn" name="idNumberdsn" type="text" class="input-field" placeholder="Designer ID">
        <input id="firstNamedsn"name="firstNamedsn" type="text" class="input-field" placeholder="First Name">
        <input id="secondNamedsn"name="secondNamedsn" type="text" class="input-field" placeholder="Second Name">
        <input id="emaildsn" name="emaildsn" type="text" class="input-field" placeholder="Email Address">
        <input id="phoneNodsn"name="phoneNodsn" type="text" class="input-field" placeholder="Phone Number">
        <input id="locationdsn"name="locationdsn" type="text" class="input-field" placeholder="Location">
        <input id="password1dsn"name="password1dsn" type="password" class="input-field" placeholder="Password">
        <input id="password2dsn"name="password2dsn"type="password" class="input-field" placeholder="Re-enter password"> <br> <br> <br>
        <button id="signupdsn"name="signupdsn" type="submit" class="submit-btn">Sign Up</button>
</form>
</div>
</div>
</body>
</html>

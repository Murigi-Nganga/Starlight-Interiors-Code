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
            <li><a href="about.php">About</a></li>
            <li><a href="services.php">Contact</a></li>
            <li><a href="login.php">Log In</a></li>
            <li><a href="signup.php">Sign Up</a></li>
        </ul>
    </nav>

<?php     //Displays successful sign up message
    if(isset($_GET['error'])) {
        echo '<div id="display-db-errors">';
        echo '<p id="closebutton" onclick="deletedbDiv()">X</p>';
        if($_GET['error'] === 'none') {
            echo "<p>You have signed up successfully</p>";
        }
        if($_GET['error'] === 'wronglogin') {
          echo "<p>You have entered incorrect login details</p>";
      }
        echo '</div>';
  } 
  ?>
  <!-- End Header -->
    <div id="display-errors"></div>

      <div class="form-box">
        <p>Log In</p> <br>
        <form id='login' class="input-group" method="POST" action="../includes/login_inc.php">
          <input id="emailorid" name="emailorid" type="text" class="input-field" placeholder="Email or ID Number">
          <input id="password" name="password" type="password" class="input-field" placeholder="Enter Password">
          <br><br>
          <label for="Select Role">Select Role</label> 
          <select name="role" id="role">
            <option value="client">Client</option>
            <option value="designer">Designer</option>
            <option value="admin">Administrator</option>
          </select>
          <br><br> <br> <br>
          <button name="login" type="submit" class="submit-btn">Log In</button>
        </form>
    </div>
  </body>
</html>

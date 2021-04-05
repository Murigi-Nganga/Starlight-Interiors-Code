<?php
    //include_once "header.php";
    if (isset($_POST["submit"])) {
        echo "You have signed up successfully!";
    }
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Login and Register</title>
    <script defer src="js/script.js" type="text/javascript" ></script>
    <link rel="stylesheet" href="css/login.css">
  </head>
  <body>
    <div class="container">
      <div class="form-box">
        <div class="button-box">
          <div id="btn">
          </div>
          <button type="button" class="toggle-btn" onclick="slideLogin()">Log In</button>
          <button type="button" class="toggle-btn" onclick="slideRegister()">Register</button>
        </div>
        <form  id="login" class="input-group"method="POST" action="includes/login_inc.php" >
          <input type="text" class="input-field" placeholder="Username or Email">
          <input type="text" class="input-field" placeholder="Enter Password" onclick="slideLogin()">
          <input type="checkbox" class="check-box"><span>Add me to the mailing list</span>
          <button type="submit" class="submit-btn">Log In</button>
        </form>
        <form id="register" class="input-group">
          <input type="text" class="input-field" placeholder="Username or Email">
          <input type="email" class="input-field" placeholder="Enter Email">
          <input type="text" class="input-field" placeholder="Enter Password">
          <input type="checkbox" class="check-box"><span>I agree to the terms & conditions</span>
          <button type="submit" class="submit-btn">Register</button>
        </form>
      </div>
    </div>
  </body>
</html>


<!--Writing error messages-->

<?php
    if (isset($_GET["error"])) {
        if ($_GET["error"] == "emptyinput") {
            echo "<p>Please fill in all fields</p>";
        }
        if ($_GET["error"] == "wronglogin") {
            echo "<p>Incorrect login information</p>";
        }
    }
?>


<?php
    include_once "header.php";
    echo '<link rel="stylesheet" href="css/login.css">';

    if (isset($_GET["error"])) {
        echo '<div id="display-errors">';
        echo '<p id="closebutton" onclick=deleteDiv() ">X</p>';
        if ($_GET["error"] === "emptyinput") {
            echo "<p>Please fill in all fields</p>";
        }
        if ($_GET["error"] === "invalidid") {
            echo "<p>Only letters are allowed for the ID</p>";
            echo "<p>ID Number must be between 7 and 10 characters</p>";
        }
        if ($_GET["error"] === "invalidname") {
            echo "<p>Only letters are allowed for the first and second names</p>";
        }
        if ($_GET["error"] === "invalidemail") {
            echo "<p>Please choose a proper email</p>";
        }
        if ($_GET["error"] === "invalidphonenumber") {
            echo "<p>Please choose a proper phone number</p>";
        }
        if ($_GET["error"] === "invalidlocation") {
            echo "<p>Only letters are allowed for the location</p>";
        }
        if ($_GET["error"] === "invalidpassword") {
            echo "<p>Password must contain one of these characters: ! @ # $ & *</p>";
            echo "<p>Password must be between 6 and 15 characters</p>";
            echo "<p>Password must have a number</p>";
        }
        if ($_GET["error"] === "passwordsdontmatch") {
            echo "<p>Passwords don't match</p>";
        }
        if ($_GET["error"] === "emailoridtaken") {
            echo "<p>A user with that id or email exists!</p>";
        }
        if ($_GET["error"] === "stmtfailed") {
            echo "<p>Something went wrong. Please try again!</p>";
        }
        if ($_GET["error"] === "none") {
            echo "<p>You have succesfully signed up!</p>";
        }
        echo '</div>';
    }
?> 
      <div class="form-box">
          <p>Sign Up</p>
<form id="register" class="input-group" method="POST" action="includes/signup_inc.php" >
  <input name="idNumber" type="text" class="input-field" placeholder="ID Number">
  <input name="firstName" type="text" class="input-field" placeholder="First Name">
  <input name="secondName" type="text" class="input-field" placeholder="Second Name">
  <input name="email" type="text" class="input-field" placeholder="Email Address">
  <input name="phoneNo" type="text" class="input-field" placeholder="Phone Number">
  <input name="location" type="text" class="input-field" placeholder="Location">
  <input id="password1" name="password1" type="password" class="input-field" placeholder="Password">
  <input name="password2"type="password" class="input-field" placeholder="Re-enter password"> <br> <br> <br>
  <!--input name="addToMailing" type="checkbox" class="check-box"><span>I agree to the terms & conditions</span-->
  <button name="signup" type="submit" class="submit-btn">Sign Up</button>
</form>
</div>
</body>
</html>

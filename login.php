<?php
    include_once "header.php";
    echo '<link rel="stylesheet" href="css/login.css">';
?>
<?php
    if (isset($_GET["error"])) {
        echo '<div id="display-errors">';
        echo '<p id="closebutton" onclick=deleteDiv() ">X</p>';
        if ($_GET["error"] === "emptyinput") {
            echo "<p>Please fill in all fields</p>";
        }
        if ($_GET["error"] === "wronglogin") {
          echo "<p>Incorrect login information</p>";
      }
        if ($_GET["error"] === "none") {
            echo "<p>You have succesfully signed up!</p>";
        }
        echo '</div>';
    }
?> 
      <div class="form-box">
        <p>Log In</p> <br>
        <form id="login" class="input-group" method="POST" action="includes/login_inc.php" >
          <input name="emailorid" type="text" class="input-field" placeholder="Email or ID Number">
          <input name="password" type="password" class="input-field" placeholder="Enter Password">
          <input type="checkbox" class="check-box"><span>Add me to the mailing list</span>
          <button name="login" type="submit" class="submit-btn">Log In</button>
        </form>
    </div>
  </body>
</html>



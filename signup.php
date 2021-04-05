<?php
    include_once "header.php";
?>
<div class="form">
    <form action="includes/signup_inc.php" method="POST">
        <label for="firstname">First Name</label>
        <br>
        <input type="text" name="fisrtname" id="firstname">
        <br>
        <label for="secondname">Second Name</label>
        <br>
        <input type="text" name="secondname" id="secondname">
        <br>
        <label for="username">Username</label>
        <br>
        <input type="text" name="username" id="username">
        <br>
        <label for="email">Email</label>
        <br>
        <input type="email" name="email" id="email">
        <br>
        <label for="phoneNo">Phone Number</label>
        <br>
        <input type="tel" name="phoneNo" id="phoneNo">
        <br>
        <label for="location">Location</label>
        <br>
        <input type="text" name="location" id="location">
        <br>
        <label for="password">Password</label>
        <br>
        <input type="password" name="password" id="password">
        <br>
        <label for="repassword">Repeat Password</label>
        <br>
        <input type="password" name="repassword" id="repassword">
        <br><br>
        <button type="submit" name="submit">Sign Up🎉</button>
    </form>
</div>

<!--Writing error messages-->

<?php
    if (isset($_GET["error"])) {
        if ($_GET["error"] == "emptyinput") {
            echo "<p>Please fill in all fields</p>";
        }
        if ($_GET["error"] == "invalidusername") {
            echo "<p>Choose a proper username</p>";
        }
        if ($_GET["error"] == "invalidemail") {
            echo "<p>Choose a proper email</p>";
        }
        if ($_GET["error"] == "invalidphonenumber") {
            echo "<p>Choose a proper phone number</p>";
        }
        if ($_GET["error"] == "invalidpassword") {
            echo "<p>Password must contain one of these characters: ! @ # $ & *</p>";
            echo "<p>Password must be between 6 and 15 characters</p>";
            echo "<p>Password must have a number</p>";
        }
        if ($_GET["error"] == "passwordsdontmatch") {
            echo "<p>Passwords don't match</p>";
        }
        if ($_GET["error"] == "usernametaken") {
            echo "<p>A user with that username or email exists!</p>";
        }
        if ($_GET["error"] == "stmtfailed") {
            echo "<p>Something went wrong. Please try again!</p>";
        }
        if ($_GET["error"] == "none") {
            echo "<p>You have succesfully signed up!</p>";
        }
    }
?>

<!--<a href="login.php">Log In</a>-->

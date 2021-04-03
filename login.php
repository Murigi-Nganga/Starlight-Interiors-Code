<?php
    include_once "header.php";
    if (isset($_POST["submit"])) {
        echo "You have signed up successfully!";
    }
?>
<div class="form">
    <form action="includes/login_inc.php" method="POST">
        <label for="username">Username or Email</label>
        <br>
        <input type="text" name="username">
        <br>
        <label for="password">Password</label>
        <br>
        <input type="password" name="password">
        <br><br>
        <button type="submit" name="submit">Log In</button>
    </form>
</div>

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


<?php

    if (isset($_POST["submit"])) {
        $fullname = $_POST["fullname"];
        $username = $_POST["username"];
        $email = $_POST["email"];
        $phoneNo = $_POST["phoneNo"];
        $location = $_POST["location"];
        $password = $_POST["password"];
        $repassword = $_POST["repassword"];

        require_once "db_inc.php";
        require_once "functions_inc.php";

        if (emptySignupInput($fullname, $username, $email, $phoneNo, $location, $password, $repassword) !== false) {
            header("location: ../signup.php?error=emptyinput");
            exit();
        }
        if (invalidUsername($username) !== false) {
            header("location: ../signup.php?error=invalidusername");
            exit();
        }
        if (invalidEmail($email) !== false) {
            header("location: ../signup.php?error=invalidemail");
            exit();
        }
        if (invalidPhoneNo($phoneNo) !== false) {
            header("location: ../signup.php?error=invalidphonenumber");
            exit();
        }
        if (invalidPassword($password) !== false) {
            header("location: ../signup.php?error=invalidpassword");
            exit();
        }
        if (passwordMatch($password, $repassword) !== false) {
            header("location: ../signup.php?error=passwordsdontmatch");
            exit();
        }
        if (userExists($conn,$username, $email) !== false) {
            header("location: ../signup.php?error=usernametaken");
            exit();
        }

        createUser($conn, $fullname, $username, $email, $phoneNo, $location, $password);

   } else {
        header("location: ../signup.php");
        exit();
   }
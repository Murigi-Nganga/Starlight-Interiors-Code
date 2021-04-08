<?php

    if (isset($_POST["signup"])) {
        $idNumber = $_POST["idNumber"];
        $firstName = $_POST["firstName"];
        $secondName = $_POST["secondName"];
        $email = $_POST["email"];
        $phoneNo = $_POST["phoneNo"];
        $location = $_POST["location"];
        $password1 = $_POST["password1"];
        $password2 = $_POST["password2"];
        /*$addToMailing = $_POST["addToMailing"];*/

        require_once "connection_inc.php";
        require_once "functions_inc.php";

        if (emptySignupInput($idNumber, $firstName, $secondName, $email, $phoneNo, $location, $password1, $password2) !== false) {
            header("location: ../signup.php?error=emptyinput");
            exit();
        }
        if(invalidIDNumber($idNumber) !== false) {
            header("location: ../signup.php?error=invalidid");
            exit();
        }
        if (invalidName($firstName, $secondName) !== false) {
            header("location: ../signup.php?error=invalidname");
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
        if (invalidName($location, $location) !== false) {
            header("location: ../signup.php?error=invalidlocation");
            exit();
        }
        if (invalidPassword($password1) !== false) {
            header("location: ../signup.php?error=invalidpassword");
            exit();
        }
        if (passwordMatch($password1, $password2) !== false) {
            header("location: ../signup.php?error=passwordsdontmatch");
            exit();
        }
        if (userExists($conn,$idNumber,$email) !== false) {
            header("location: ../signup.php?error=emailoridtaken");
            exit();
        }

        createUser($conn, $idNumber, $firstName, $secondName, $email, $phoneNo, $location, $password);

   } else {
        header("location: ../signup.php");
        exit();
   }

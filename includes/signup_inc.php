<?php

    if (isset($_POST["signup"])) {

        $idNumber = $_POST["idNumber"];
        $firstName = $_POST["firstName"];
        $secondName = $_POST["secondName"];
        $email = $_POST["email"];
        $phoneNo = $_POST["phoneNo"];
        $location = $_POST["location"];
        $password1 = $_POST["password1"];

        require_once "connection_inc.php";
        require_once "functions_inc.php";

        if (userExists($conn,$idNumber,$email) !== false) {
            header("location: ../php/signup.php?error=emailoridtaken");
            exit();
        }

        createUser($conn, $idNumber, $firstName, $secondName, $email, $phoneNo, $location, $password1); ///////Error - 2 Days

   } else {
        header("location: ../php/signup.php");
        exit();
   }

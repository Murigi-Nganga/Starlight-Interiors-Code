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

   } elseif (isset($_POST["signupdsn"])) {
        $idNumberdsn = $_POST["idNumberdsn"];
        $firstNamedsn = $_POST["firstNamedsn"];
        $secondNamedsn = $_POST["secondNamedsn"];
        $emaildsn = $_POST["emaildsn"];
        $phoneNodsn = $_POST["phoneNodsn"];
        $locationdsn = $_POST["locationdsn"];
        $password1dsn = $_POST["password1dsn"];

        require_once "connection_inc.php";
        require_once "functions_inc.php";


        if (designerExists($conn,$idNumberdsn,$emaildsn) !== false) {
            header("location: ../php/signup.php?error=emailoridtaken");
            exit();
        }

        createDesigner($conn, $idNumberdsn, $firstNamedsn, $secondNamedsn, $emaildsn, $phoneNodsn, $locationdsn, $password1dsn); 
   } else {
        header("location: ../php/signup.php");
        exit();
   }

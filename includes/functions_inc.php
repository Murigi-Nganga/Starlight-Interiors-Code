<?php

function emptySignupInput($idNumber, $firstName, $secondName, $email, $phoneNo, $location, $password1, $password2) {
        $result = false;
        if (empty($idNumber) || empty($firstName) || empty($secondName) || empty($email) || empty($phoneNo) || empty($location) || empty($password1) || empty($password2)) {
            $result = true;
        }
        return $result;
    }

    function invalidIDNumber($idNumber) {
        $result = false;
        if (!(is_numeric($idNumber)) && (strlen($idNumber)<10 || strlen($idNumber)>7 )) {
            $result = true;
        }
        return $result;
    }

    function invalidName($firstName, $secondName) {
        $result = false;
        if (!(preg_match("/^[a-zA-Z]*$/", $firstName) && preg_match("/^[a-zA-Z]*$/", $secondName))) {
            $result = true;
        }
        return $result;
    }

    function invalidEmail($email) { 
        $result = false;
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $result = true;
        }
        return $result;
    }

    function invalidPhoneNo($phoneNo) {
        $result = false;
        $validNum = filter_var($phoneNo, FILTER_SANITIZE_NUMBER_INT);
        $validNum = str_replace("+", "", $validNum);
        $validNum = str_replace("-", "", $validNum);
        if (strlen($validNum) < 10 || strlen(strlen($validNum) > 15) ) {
            $result = true;
        }
        return $result;
    }

    function invalidPassword($password) {
        $result = false;
        $hasChar = false;
        $hasNum = false;
        $mustHaveChar = ["!", "@", "#", "$", "&", "*"];
        foreach (str_split($password) as $item) {
            if (is_numeric($item)){
                $hasNum = true;
                break;
            }
        }
        foreach (str_split($password) as $item) {
            foreach ($mustHaveChar as $char) {
                if ($item == $char) {
                    $hasChar = true;
                    break;
                }
            }
        }
        if(strlen($password) < 6 || strlen($password) > 15 || $hasChar === false || $hasNum === false) {
            $result = true;
        }
        return $result;
    }

    function passwordMatch($password1, $password2) {
        $result = false;
        if ($password1 !== $password2) {
            return true;
        }
        return $result;
    }

    function userExists($conn,$idNumber,$email) {     //Used for sign up and log in to check if the user exists
        $sql = "SELECT * FROM clients WHERE IdNumber = ? OR Email = ?"; 
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)) {
            header("location: signup.php?error=stmtfailed"); //To change error
            exit();
        }
        mysqli_stmt_bind_param($stmt, "is", $idNumber,  $email);
        mysqli_stmt_execute($stmt);
        $resultData = mysqli_stmt_get_result($stmt);

        if ($row = mysqli_fetch_assoc($resultData)) {
            return $row;
        } else {
            $result = false;
            return $result;
        }
        mysqli_stmt_close($stmt);
    }

    function createUser($conn, $idNumber, $firstName, $secondName, $email, $phoneNo, $location, $password) {
        $sql = "INSERT INTO clients (IdNumber, FirstName, SecondName, Email, PhoneNumber, Location, Password) VALUES (?, ?, ?, ?, ?, ?,?);"; //Used to execute dynamic sql
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)) {
            header("location: signup.php?error=stmtfailed"); 
            exit();
        }

        $hashpassword = password_hash($password, PASSWORD_DEFAULT);

        mysqli_stmt_bind_param($stmt, "isssiss", $idNumber, $firstName, $secondName, $email, $phoneNo, $location, $hashpassword);
        mysqli_stmt_execute($stmt);
        header("location: ../login.php?error=none");
        exit();
    }

    function emptyLoginInput($emailorid, $password) {
        $result = false;
        if (empty($emailorid) || empty($password)) {
            $result = true;      
        }
        return $result;
    }

    function loginUser($conn, $emailorid, $password) {
        $userExists = userExists($conn,$emailorid,$emailorid);

        if ($userExists === false) {
            header("location: ../login.php?error=wronglogin");   
            exit();
        }

        $hashedpassword = $userExists["Password"];
        
        $checkPassword = password_verify($password, $hashedpassword);

        if ($checkPassword === false) {
        header("location: ../login.php?error=wronglogin");
            exit();
        }

        else if ($checkPassword === true) {
            session_start();                        //Start a session if the password is correct
            $_SESSION["IdNumber"] = $userExists["IdNumber"];
            $_SESSION["FirstName"] = $userExists["FirstName"];
            header("location: ../index.php");
            exit();
        }
    }

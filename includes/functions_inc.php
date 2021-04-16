<?php
    //Sign Up Functions
    function userExists($conn,$idNumber,$email) {     //Used for sign up and log in to check if the user exists
        $sql = 'SELECT * FROM clients WHERE IdNumber = ? OR Email = ?'; 
        $stmt = $conn->prepare($sql);
        if(!$stmt) {
            header("location: ../php/signup.php?error=stmtfailed"); //To change error
            exit();
        }

        $stmt->execute([$idNumber, $email]);

        if ($row = $stmt->fetch()) {
            return $row;
        } else {
            $result = false;
            return $result;
        }

    }

    function createUser($conn, $idNumber, $firstName, $secondName, $email, $phoneNo, $location, $password) {
        $sql = "INSERT INTO clients (IdNumber, FirstName, SecondName, Email, PhoneNumber, Location, Password) 
                    VALUES (?, ?, ?, ?, ?, ?,?);"; //Used to execute dynamic sql
        $stmt = $conn->prepare($sql);;
        if(!$stmt) {
            header("location: ../php/signup.php?error=stmtfailed"); 
            exit();
        }

        $hashpassword = password_hash($password, PASSWORD_DEFAULT);

        $stmt->execute([$idNumber, $firstName, $secondName, $email, $phoneNo, $location,$hashpassword]);

        header("location: ../php/login.php?error=none");
        exit();
    }

    //Log In Function
    function loginUser($conn, $emailorid, $password) {
        $userExists = userExists($conn,$emailorid,$emailorid);

        if ($userExists === false) {
            header("location: ../php/login.php?error=wronglogin");   
            exit();
        }
        $hashedpassword = $userExists["Password"];
        
        $checkPassword = password_verify($password, $hashedpassword);


        if ($checkPassword === false) {
        header("location: ../php/login.php?error=wronglogin");
            exit();
        }
        else if ($checkPassword === true) {
            session_start();                        //Start a session if the password is correct
            $_SESSION["IdNumber"] = $userExists["IdNumber"];
            $_SESSION["FirstName"] = $userExists["FirstName"];
            header("location: ../php/index.php");
            exit();
        }
    }

    //Requirements Functions
    function createRequirement($conn,$typeOfRoom,$roomPic,$approxSize,$colors, $disColors, $floorType, $wallCovering, $inspoPic, $specialNeeds, $budget, $anyOtherInfo) {
        $sql = "INSERT INTO requirements ('TypeOfRoom, RoomPic, ApproxSize, Colors, DisColors, FloorType, WallCovering, InspoPic, SpecialNeeds, Budget, AnyOtherInfo') 
        VALUES (?, ?, ?, ?, ?, ?,?);"; //Used to execute dynamic sql

        $stmt = $conn->prepare($sql);;
        if(!$stmt) {
        header("location: ../php/signup.php?error=stmtfailed"); 
        exit();
        }

        $stmt->execute([$typeOfRoom,$roomPic,$approxSize,$colors, $disColors, $floorType, $wallCovering, $inspoPic, $specialNeeds, $budget, $anyOtherInfo]);

        header("location: ../php/requirements.php?error=none");
        exit();
    }
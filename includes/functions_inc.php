<?php
    /**************************************Client Functions**********************************************/
    //Check if Client exists
    function userExists($conn,$idNumber,$email) {     //Used for sign up and log in to check if the user exists
        $sql = 'SELECT * FROM clients WHERE ClientID = ? OR Email = ?'; 
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

    //Add a Client
    function createUser($conn, $idNumber, $firstName, $secondName, $email, $phoneNo, $location, $password) {
        $sql = "INSERT INTO clients (ClientID, FirstName, SecondName, Email, PhoneNumber, Location, Password) 
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

    //Client Login
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
            $_SESSION["ClientID"] = $userExists["ClientID"];
            $_SESSION["FirstName"] = $userExists["FirstName"];
            header("location: ../php/index.php");
            exit();
        }
    }

        //Create Client's Requirements
        function createRequirement($conn,$typeOfRoom,$roomPic,$approxSize,$colors, $disColors, $floorType, $wallCovering, 
        $inspoPic, $specialNeeds, $budget, $anyOtherInfo) {
            $sql = "INSERT INTO requirements ('TypeOfRoom, RoomPic, ApproxSize, Colors, DisColors, 
            FloorType, WallCovering, InspoPic, SpecialNeeds, Budget, AnyOtherInfo') 
            VALUES (?, ?, ?, ?, ?, ?,?);"; //Executes dynamic sql
    
            $stmt = $conn->prepare($sql);;
            if(!$stmt) {
            header("location: ../php/signup.php?error=stmtfailed"); 
            exit();
            }
    
            $stmt->execute([$typeOfRoom,$roomPic,$approxSize,$colors, $disColors, $floorType, $wallCovering, $inspoPic, $specialNeeds, $budget, $anyOtherInfo]);
    
            header("location: ../php/requirements.php?error=none");
            exit();
        }



    /*****************************************Designer Functions*************************************************/
    //Check if Designer Exists
    function designerExists($conn,$idNumber,$email) {     //Used for sign up and log in to check if the user exists
        $sql = 'SELECT * FROM designers WHERE DesignerID = ? OR Email = ?'; 
        $stmt = $conn->prepare($sql);
        if(!$stmt) {
            header("location: ../php/login.php?error=stmtfailed"); //To change error
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

    //Designer Login
    function loginDesigner($conn, $emailorid, $password) {
        $designerExists = designerExists($conn,$emailorid,$emailorid);

        if ($designerExists === false) {
            header("location: ../php/login.php?error=wronglogin");   
            exit();
        }
        $hashedpassword = $designerExists["Password"];
        
        $checkPassword = password_verify($password, $hashedpassword);


        if ($checkPassword === false) {
        header("location: ../php/login.php?error=wronglogin");
            exit();
        }
        else if ($checkPassword === true) {
            session_start();                        //Start a session if the password is correct
            $_SESSION["DesignerID"] = $designerExists["DesignerID"];
            $_SESSION["FirstName"] = $designerExists ["FirstName"];
            header("location: ../php/index.php");
            exit();
        }
    }

    /********************************************Admin Funstions*****************************************************/
    //Check if Admin exists
    function adminExists($conn,$idNumber,$email) {     //Used for sign up and log in to check if the user exists
        $sql = 'SELECT * FROM admins WHERE AdminID = ? OR Email = ?'; 
        $stmt = $conn->prepare($sql);
        if(!$stmt) {
            header("location: ../php/login.php?error=stmtfailed"); //To change error
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

    //Admin Login
    function loginAdmin($conn, $emailorid, $password) {
        $adminExists = adminExists($conn,$emailorid,$emailorid);

        if ($adminExists === false) {
            header("location: ../php/login.php?error=wronglogin");   
            exit();
        }
        $hashedpassword = $adminExists["Password"];
        
        $checkPassword = password_verify($password, $hashedpassword);


        if ($checkPassword === false) {
        header("location: ../php/login.php?error=wronglogin");
            exit();
        }
        else if ($checkPassword === true) {
            session_start();                        //Start a session if the password is correct
            $_SESSION["AdminID"] = $adminExists["AdminID"];
            header("location: ../php/index.php");
            exit();
        }
    }

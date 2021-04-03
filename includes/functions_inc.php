<?php
    function emptySignupInput($fullname, $username, $email, $phoneNo, $location, $password, $repassword) {
        $result = false;
        if (empty($fullname) || empty($username) || empty($email) || empty($phoneNo) || empty($location) || empty($password) || empty($repassword)) {
            $result = true;      //Yes, there is a mistake
        }
        return $result;
    }

    function invalidUsername($username) {
        $result = false;
        if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) { 
            $result = true;
        }
        return $result;
    }

    function invalidEmail($email) {     ////To review this
        $result = false;
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $result = true;
        }
        return $result;
    }

    function invalidPhoneNo($phoneNo) {    ////To review this
        $result = false;
        $validNum = filter_var($phoneNo, FILTER_SANITIZE_NUMBER_INT);
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
                echo "Number has been found";
                break;
            }
        }
        foreach (str_split($password) as $item) {
            foreach ($mustHaveChar as $char) {
                if ($item == $char) {
                    $hasChar = true;
                    echo "Character has been found";
                    break;
                }
            }
        }
        if(strlen($password) < 6 || strlen($password) > 15 || $hasChar == false || $hasNum == false) {
            $result = true;
        }
        return $result;
    }

    function passwordMatch($password, $repassword) {
        $result = false;
        if (!$password == $repassword) {
            return true;
        }
        return $result;
    }

    function userExists($conn,$username,$email) {
        $sql = "SELECT * FROM users WHERE Username = ? OR Email = ?;"; //Used to execute dynamic sql
        $stmt = mysqli_stmt_init($conn); // Use prepared statements to make it secure and run without input from the user

        if(!mysqli_stmt_prepare($stmt, $sql) ) {
            header: ("location: ../includes/signup.php?error=stmtfailed");
            exit();
        }

        mysqli_stmt_bind_param($stmt, "ss", $username, $email);
        mysqli_stmt_execute($stmt);
        $resultData = mysqli_stmt_get_result($stmt);

        if ($row = mysqli_fetch_assoc($resultData)) { //To give function a second purpose
            return $row;
        } else  {
            $result = false;
            return $result;
        }
        mysqli_stmt_close($stmt);
    }

    /*function createUser($conn, $fullname, $username, $email, $phoneNo, $location, $password) {
        $sql = "INSERT INTO users (FullName, Username, Email, PhoneNo, Location, Userpass) VALUES ('$fullname', '$username', '$email', '$phoneNo', '$location', '$password');";
        $run_query = mysqli_query($conn,$sql);
        if(!$run_query) {
            echo "Could not run query!!";
        }
    }*/

    function createUser($conn, $fullname, $username, $email, $phoneNo, $location, $password) {
        $sql = "INSERT INTO users (FullName, Username, Email, PhoneNo, Location, Userpass) VALUES (?, ?, ?, ?, ?, ?);"; //Used to execute dynamic sql
        $stmt = mysqli_stmt_init($conn); // Use prepared statements to make it secure and run without input from the user

        if(!mysqli_stmt_prepare($stmt, $sql) ) {
            header: ("location: ../includes/signup.php?error=stmtfailed");
            exit();
        }

        $hashpassword = password_hash($password, PASSWORD_DEFAULT);
        echo $hashpassword;

        mysqli_stmt_bind_param($stmt, "ssssss", $fullname, $username, $email, $phoneNo, $location, $hashpassword);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        header("location: ../signup.php?error=none");
        //exit(); - To exclude to allow user to be redirected to the Log in Page in signup_inc.php
    }

    function emptyLoginInput($username, $password) {
        $result = false;
        if (empty($username) || empty($password)) {
            $result = true;      //Yes, there is a mistake
        }
        return $result;
    }

    function loginUser($conn, $username, $password) {
        $userExists = userExists($conn,$username,$username);//Used twice (fits into email or username) + returns array

        if ($userExists == false) {
            header("location: ../login.php?error=wronglogin");
            exit();
        }

        $hashpassword = $userExists["Userpass"];
        $checkPassword = password_verify($password, $hashpassword);

        if ($checkPassword == false) {
            header("location: ../login.php?error=wronglogin");
            exit();
        }
        else if ($checkPassword == true) {
            session_start();                        //Start a session if the password is correct
            $_SESSION["userId"] = $userExists["userId"];
            $_SESSION["Username"] = $userExists["Username"];
            header("location: ../index.php");
            exit();
        }
    }



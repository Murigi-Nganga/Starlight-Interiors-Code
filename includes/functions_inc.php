<?php
    date_default_timezone_set("Africa/Nairobi");
    /**************************************CLIENT/USER FUNCTIONS**********************************************/
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
            $_SESSION["userID"] = $userExists["ClientID"];
            $_SESSION["role"] = "client";
            $_SESSION["FirstName"] = $userExists["FirstName"];
            header("location: ../php/index.php");
            exit();
        }
    }

        //Create Client's Requirements
        function createRequirement($conn,$clientID,$typeOfRoom,$roomPic,$approxSize,$colors, $disColors, $floorType, $wallCovering, 
        $inspoPic, $specialNeeds, $budget, $anyOtherInfo, $submissionDate) {

            $sql = "INSERT INTO requirements (ClientID, RoomType, RoomPicture, RoomSize, FavColors, DisColors, 
            FloorType, WallType, InspoPic, SpecialNeeds, Budget, AnyOtherInfo, SubmissionDate) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);"; //Executes dynamic sql
    
            $stmt = $conn->prepare($sql);
            if(!$stmt) {
            header("location: ../php/requirements.php?error=stmtfailed"); 
            exit();
            }
    
            $stmt->execute([$clientID,$typeOfRoom,$roomPic,$approxSize,$colors, $disColors, $floorType, $wallCovering, $inspoPic, 
            $specialNeeds, $budget, $anyOtherInfo, $submissionDate]);
    
            header("location: ../php/requirements.php?error=none");
            exit();
        }


        function addRemarks($conn, $drawingID, $remarks) {
            $sql = "UPDATE drawings SET ClientsRemarks = ? WHERE DrawingID = ?;"; 
    
            $stmt = $conn->prepare($sql);
            if(!$stmt) {
            header("location: ../php/drawings.php?error=stmtfailed"); 
            exit();
            }
    
            $stmt->execute([$remarks, $drawingID]);
    
            header("location: ../php/drawings.php?error=none");
            exit();
        }
        //Submit Payment Details
        function submitPayment($conn,$clientID,$amountPaid, $paymentPlatform, $paymentPurpose, $submissionDate) {
            $sql = "INSERT INTO payments (ClientID, AmountPaid, PaymentPlatform, PaymentPurpose, SubmissionDate) 
            VALUES (?, ?, ?, ?, ?);"; 
    
            $stmt = $conn->prepare($sql);
            if(!$stmt) {
            header("location: ../php/payments.php?error=stmtfailed"); 
            exit();
            }
    
            $stmt->execute([$clientID,$amountPaid, $paymentPlatform, $paymentPurpose, $submissionDate]);
    
            header("location: ../php/payments.php?error=none");
            exit();
        }


    /*****************************************DESIGNER FUNCTIONS*************************************************/
    //Check if Designer Exists
    function designerExists($conn,$idNumber,$email) {     //Used for sign up and log in to check if the user exists

        $sql = 'SELECT * FROM designers WHERE DesignerID = ? OR Email = ?'; 
        $stmt = $conn->prepare($sql);
        if(!$stmt) {
            header("location: ../php/login.php?error=stmtfailed"); 
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

    //Add a Designer
    function createDesigner($conn, $idNumber, $firstName, $secondName, $email, $phoneNo, $location, $password) {

        $sql = "INSERT INTO designers (DesignerID, FirstName, SecondName, Email, PhoneNumber, Location, Password) 
                    VALUES (?, ?, ?, ?, ?, ?,?);"; 
        $stmt = $conn->prepare($sql);
        if(!$stmt) {
            header("location: ../php/signup.php?error=stmtfailed"); 
            exit();
        }

        $hashpassword = password_hash($password, PASSWORD_DEFAULT);

        $stmt->execute([$idNumber, $firstName, $secondName, $email, $phoneNo, $location,$hashpassword]);

        header("location: ../php/login.php?error=none");
        exit();
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
            session_start();                        
            $_SESSION["userID"] = $designerExists["DesignerID"];
            $_SESSION["role"] = "designer";
            $_SESSION["FirstName"] = $designerExists ["FirstName"];
            header("location: ../php/index.php");
            exit();
        }
    }

    function dsnHasThisClient($conn, $clientID, $designerID) {           //Ensures a drawing is submitted only if the desiger is connected to a client with that ID
        $userExists = userExists($conn,$clientID,$clientID);

        if ($userExists === false) {
            header("location: ../php/drawings.php?error=clientdoesntexist");   
            exit();
        }

        $sql = 'SELECT * FROM assignments WHERE ClientID = ? AND DesignerID = ?'; 
        $stmt = $conn->prepare($sql);
        if(!$stmt) {
            header("location: ../php/signup.php?error=stmtfailed");
            exit();
        }

        $stmt->execute([$clientID, $designerID]);

        if ($row = $stmt->fetch()) {
            return true;                                                    //Change to return row if need be
        } else {
            return false;
        }
    }

    function createDrawing($conn, $designerID, $drawingPicDestination, $drawingDescription, $drawingPrice, $submissionDate, $clientID) {

        $sql = "INSERT INTO drawings (DesignerID, DrawingPic, DrawingDescription, SubmissionDate, ClientID, DrawingPrice) 
        VALUES (?, ?, ?, ?, ?, ?);"; 

        $stmt = $conn->prepare($sql);
        if(!$stmt) {
        header("location: ../php/drawings.php?error=stmtfailed"); 
        exit();
        }

        $stmt->execute([$designerID, $drawingPicDestination, $drawingDescription, $submissionDate, $clientID, $drawingPrice]);

        //If the creation is successful, push notification to the client
        $designerExists = designerExists($conn, $designerID, $designerID);
        $message = "Your designer with the ID " .$designerExists["DesignerID"]. " (" 
                          .$designerExists["FirstName"]. " " .$designerExists["SecondName"]. ") has submitted a drawing for you!";

        pushNotification($conn, $clientID, $message, 'drawings', $submissionDate);

        header("location: ../php/drawings.php?error=none");
        exit();

    }

    function createTask($conn, $designerID, $taskMessage, $creationDate) {

        $sql = "INSERT INTO tasks (DesignerID, TaskMessage, CreationDate) 
        VALUES (?, ?, ?);"; 

        $stmt = $conn->prepare($sql);
        if(!$stmt) {
        header("location: ../php/tasks.php?error=stmtfailed"); 
        exit();
        }

        $stmt->execute([$designerID, $taskMessage, $creationDate]);
        
        header("location: ../php/tasks.php?error=none");
        exit();
    }

    function deleteTask($conn, $designerID, $taskID) {
        $sql = "DELETE FROM tasks WHERE TaskID = ? AND DesignerID = ?;"; 

        $stmt = $conn->prepare($sql);
        if(!$stmt) {
        header("location: ../php/tasks.php?error=stmtfailed"); 
        exit();
        }

        $stmt->execute([$taskID, $designerID]);
        
        header("location: ../php/tasks.php?error=none");
        exit();
    }

    function completedTask($conn, $designerID, $taskID) {
        $sql = 'UPDATE tasks SET TaskStatus = "done" WHERE TaskID = ? AND DesignerID = ?'; 

        $stmt = $conn->prepare($sql);
        if(!$stmt) {
        header("location: ../php/tasks.php?error=stmtfailed"); 
        exit();
        }

        $stmt->execute([$taskID, $designerID]);
        
        header("location: ../php/tasks.php?error=none");
        exit();
    }

    /********************************************ADMIN FUNCTIONS*****************************************************/
    //Check if Admin exists
    function adminExists($conn,$idNumber,$email) {   
        $sql = 'SELECT * FROM admins WHERE AdminID = ? OR Email = ?'; 
        $stmt = $conn->prepare($sql);
        if(!$stmt) {
            header("location: ../php/login.php?error=stmtfailed"); 
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

        if (!($password === $adminExists["Password"])) {
            header("location: ../php/login.php?error=wronglogin");
            exit();
        }
        else if ($password === $adminExists["Password"]) {
            session_start();                        
            $_SESSION["userID"] = $adminExists["AdminID"];
            $_SESSION["role"] = "admin";
            header("location: ../php/index.php");
            exit();
        }
    }

    function assignmentExists($conn, $clientID) {                       //Check if the assignment already exists
        $sql = 'SELECT * FROM assignments WHERE ClientID = ?'; 
        $stmt = $conn->prepare($sql);
        if(!$stmt) {
            header("location: ../php/signup.php?error=stmtfailed");
            exit();
        }

        $stmt->execute([$clientID]);

        if ($row = $stmt->fetch()) {
            return $row;
        } else {
            $result = false;
            return $result;
        }
    }

    function assignClient($conn, $clientID, $dsnEmailorId, $today, $requirementsID) {           //fill requirements AssignedDesigner column, fill assignment table, 
        $designerExists = designerExists($conn,$dsnEmailorId,$dsnEmailorId);                      //Push notifications
        //Add assigned Designer's ID
        if ($designerExists === false) {
            header("location: ../php/requirements.php?error=dsndoesntexist");   
            exit();                                                             
        }

        $sql  = "UPDATE requirements SET AssignedDesigner= ? WHERE RequirementsID= ?;";
        $stmt = $conn->prepare($sql);

        if(!$stmt) {
            header("location: ../php/requirements.php?error=stmtfailed");
        }

        $stmt->execute([$designerExists["DesignerID"], $requirementsID]);

            $sql  = "INSERT INTO assignments (ClientID, DesignerID, AssignmentDate, RequirementsID) VALUES (?, ?, ?, ?);";
            $stmt = $conn->prepare($sql);
            
            if(!$stmt) {
            header("location: ../php/requirements.php?error=asnmtfailed");   
            exit();
            }

            $stmt->execute([$clientID, $designerExists["DesignerID"], $today, $requirementsID]);
            $userExists = userExists($conn, $clientID, $clientID);                                                      //To get client's other details

            $clientMessage = "You have been assigned to the designer with the ID number ".$designerExists["DesignerID"]."<br>".
            "Name: ".$designerExists["FirstName"]." ".$designerExists["SecondName"]."<br>".
            "Email: ".$designerExists["Email"]."<br>".
            "PhoneNumber: ".$designerExists["PhoneNumber"]."<br>".
            "We cannot wait for you to land on the design you love!";

            $designerMessage = "You have been assigned to the client with the ID number ".$userExists["ClientID"]."<br>".
            "Name: ".$userExists["FirstName"]." ".$userExists["SecondName"]."<br>".
            "Email: ".$userExists["Email"]."<br>".
            "PhoneNumber: ".$userExists["PhoneNumber"]."<br>"; 

            pushNotification($conn, $clientID, $clientMessage, 'requirements', $today);     //Push notification to the client
            pushNotification($conn, $designerExists["DesignerID"], $designerMessage, 'requirements', $today);    //Push notification to the designer
            
            header("location: ../php/requirements.php?error=none");   
            exit();
    }

    function getPaymentDetails($conn, $clientID, $paymentID) {                                             //Gets payment details
        $sql = 'SELECT * FROM payments WHERE paymentID = ? AND clientID = ?'; 
        $stmt = $conn->prepare($sql);
        if(!$stmt) {
            header("location: ../php/signup.php?error=stmtfailed");
            exit();
        }

        $stmt->execute([$paymentID, $clientID]);
        $row = $stmt->fetch();
            return $row;

    }

    function confirmPayment($conn, $clientID, $paymentID, $today) {            //Confirms payment and pushes notification to the client

        $sql = "UPDATE payments SET PaymentStatus = 'confirmed' WHERE PaymentID = $paymentID AND ClientID = $clientID ;";

        $paymentDetails = getPaymentDetails($conn, $clientID, $paymentID);
        print_r($paymentDetails);

        if($conn->query($sql)) {

            $message = "The payment you made on ". $paymentDetails["SubmissionDate"] . " of the amount Ksh " .$paymentDetails["AmountPaid"] ." for ". $paymentDetails["PaymentPurpose"] ." has been confirmed!";

            pushNotification($conn, $clientID, $message, 'payments', $today);

            header("location: ../php/payments.php?error=none");   
            exit();

        } else {

            header("location: ../php/payments.php?error=notconfirmed");   
            exit();

        }

    }

    function getDrawingsNumber($conn, $clientID) {
        $sql = "SELECT * FROM drawings WHERE ClientID = ?";
        $stmt = $conn->prepare($sql);
        if(!$stmt) {
            header("location: ../php/progress.php?error=stmtfailed"); 
            exit();
        }

        $stmt->execute([$clientID]);
        $numberOfDrawings = $stmt->rowCount();
        return $numberOfDrawings;
    }

    function getDrawingPrice($conn, $drawingID) {
        $sql = "SELECT * FROM drawings WHERE ClientID = ?";
        $stmt = $conn->prepare($sql);
        if(!$stmt) {
            header("location: ../php/progress.php?error=stmtfailed"); 
            exit();
        }

        $stmt->execute([$drawingID]);
        $row = $stmt->fetch();
        return $row["DrawingPrice"];
    }

    function completeWork($conn, $requirementsID, $clientID, $completionDate) {
        $sql = "UPDATE requirements SET WorkCompleted = ? WHERE RequirementsID = ? AND ClientID = ?;";
        $stmt = $conn->prepare($sql);
        if(!$stmt) {
            header("location: ../php/progress.php?error=stmtfailed"); 
            exit();
        }
        
        $stmt->execute(['yes', $requirementsID, $clientID]);

        $sql = "UPDATE assignments SET CompletionDate = ? WHERE RequirementsID = ? AND ClientID = ?;";
        if(!$stmt) {
            header("location: ../php/progress.php?error=stmtfailed"); 
            exit();
        }
        $stmt = $conn->prepare($sql);
        $stmt->execute([$completionDate, $requirementsID, $clientID]);
        $message = "Thank you for working with us! <br>Your work has been completed!";
        pushNotification($conn, $clientID, $message,'requirements', $completionDate);

        header("location: ../php/progress.php?error=none"); 
        exit();

    }

    /****************************************************ALL USER FUNCTIONS***************************************************** */
    function pushNotification($conn, $receiverID, $message, $notificationTag, $creationDate) {
        $sql = "INSERT INTO notifications (ReceiverID, Message, NotificationTag, CreationDate) 
        VALUES (?, ?, ?, ?);"; 
        $stmt = $conn->prepare($sql);
        if($stmt) {
            $stmt->execute([$receiverID, $message, $notificationTag, $creationDate]);
        }
    }

    function getUserDetails($conn, $table, $id, $columnName) {                  //Fetches Details for designers or clients
        $sql = "SELECT * FROM ".$table." WHERE ".$columnName." = ?"; 
        $stmt = $conn->prepare($sql);

        if(!$stmt) {
            header("location: ../php/requirements.php?error=stmtfailed"); 
            exit();
        }

        $stmt->execute([$id]);
        if ($row = $stmt->fetch()) {
            return $row;
        }
        
    }

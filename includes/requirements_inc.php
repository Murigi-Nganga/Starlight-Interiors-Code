<?php

     if (isset($_POST["submit-req"])) {

          $typeOfRoom = $_POST["typeofroom"];
          $roomPic = $_POST["roompic"];
          $approxSize = $_POST["approxsize"];
          $colors = $_POST["colors"];
          $disColors = $_POST["discolors"];
          $floorType= $_POST["floortype"];
          $wallCovering = $_POST["wallcovering"];
          $inspoPic = $_FILES["inspopic"];
          $specialNeeds = $_POST["specialneeds"];
          $budget = $_POST["budget"];
          $anyOtherInfo = $_POST["anyotherinfo"];
          require_once "connection_inc.php";

          $fileName = $_FILES['file']['name'];
          $fileTmpName = $_FILES['file']['tmp_name'];
          $fileSize = $_FILES['file']['size'];
          $fileError = $_FILES['file']['error'];
          $fileType = $_FILES['file']['type'];
          $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
          $allowedExt = array("jpeg", "jpg", "png");


                if ($fileError === 0) {
                    if ($fileSize > 500000) {
                        header("Location: index.php?error=filesizetoobig");
                        exit();   
                    } else {
                        $newFileName = uniqid('IMG-', true).".".$fileExt;
                        $fileDestination = "../uploads/".$newFileName;
                        move_uploaded_file($fileTmpName, $fileDestination);
                        $sql = "INSERT INTO images (image_url) VALUES ('$fileDestination')";
                        $results = $pdo->exec($sql);
                        if (!$results) {
                            echo "Sorry there was an error uploading the image to the database!!!";
                        }
                        header("Location: display.php");
                    }
                } else {
                    header("Location: index.php?error=erroruploadingfile");
                    exit();                      
                }   





        require_once "connection_inc.php";
        require_once "functions_inc.php";


   } else {
        header("location: ../php/signup.php");
        exit();
   }
    
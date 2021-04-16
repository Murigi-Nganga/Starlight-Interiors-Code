<?php

    if (isset($_POST["submit-req"])) {

        $typeOfRoom = $_POST["typeofroom"];
        $roomPic = $_POST["roompic"];
        $approxSize = $_POST["approxsize"];
        $colors = $_POST["colors"];
        $disColors = $_POST["discolors"];
        $floorType= $_POST["floortype"];
        $wallCovering = $_POST["wallcovering"];
        $inspoPic = $_POST["inspopic"];
        $specialNeeds = $_POST["specialneeds"];
        $budget = $_POST["budget"];
        $anyOtherInfo = $_POST["anyotherinfo"];

        require_once "connection_inc.php";
        require_once "functions_inc.php";


   } else {
        header("location: ../php/signup.php");
        exit();
   }
    
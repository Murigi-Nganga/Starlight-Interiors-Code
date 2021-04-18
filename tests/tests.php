<?php
//Test Connection to database
    $dbhost = "localhost";
    $dbuser = "root";
    $dbpassword = "";
    //$dbname = "interior_design";     ---- Testing the connection to the actual databse
    //Testing the connection to the "test: database
    $dbname = "test";

    $dsn = 'mysql:host='.$dbhost.';port=3306;dbname='.$dbname;
    
    $dboptions = [
        PDO::ATTR_ERRMODE                     => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES      => false
    ];

    try {
        $conn  = new PDO($dsn, $dbuser, $dbpassword, $dboptions);
       } catch (PDOException $error) {
        echo "Connection failed: " . $error->getMessage();
        exit;
       }


        $sql = file_get_contents("test.sql");      
        $conn->exec($sql);

//$sql_lines = explode(';', $sql);     //Separator, input_string....... 
//    $conn->query($sql);      --------->Executing several lines without prepared statements
//    Successful
// *********************************************
//Using prepared statements





<?php
    $dbhost = "localhost";
    $dbuser = "root";
    $dbpassword = "";
    $dbname = "interior_design";

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
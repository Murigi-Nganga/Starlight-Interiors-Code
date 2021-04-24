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


        // $sql = file_get_contents("test.sql");      
        // $conn->exec($sql);--------->Executing several lines without prepared statements

//$sql_lines = explode(';', $sql);     //Separator, input_string....... 
//    $conn->query($sql);      
//    Successful
// *********************************************
//Updating table data

$sql = file_get_contents("test.sql");  

$result = $conn->exec($sql);

//$rows = $result->fetch();
    
    if(count($rows) > 0){
        echo " 
        <tr>
            <th>ID Number</th>
            <th>First Name</th>
            <th>Second Name</th>
            <th>Email</th>
            <th>Date Of Birth</th>
            <th>County</th>
            <th>Gender</th>
        </tr>    
        ";
        foreach($rows as $row){
            echo "
            <tr>
                <td>".$row['id']."</td>
                <td>".$row['FirstName']."</td>
                <td>".$row['SecondName']."</td>
                <td>".$row['Email']."</td>
                <td>".$row['DateOfBirth']."</td>
                <td>".$row['County']."</td>
                <td>".$row['Gender']."</td>
            </tr>
            ";
        }
    } else {
        echo "<h3>No Records Found</h3>";
    }


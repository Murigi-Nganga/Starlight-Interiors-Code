<?php 
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/tasks.css">
    <script defer src="../js/tasks.js"></script>
    <title>Designer's Tasks</title>
</head>
        <body>
            <nav id= "nav">
                <div class="logo">
                    <img src="../images/logo.png" alt="Image of a camel">
                </div>
                <div class="coname">
                    Starlight Interiors
                </div>
                <ul>
                    <li><a href="../php/index.php">Home</a></li>
                    <li><a href="../php/requirements.php">Requirements</a></li>
                    <li><a href="../php/drawings.php" >Drawings</a></li>
                    <li><a href="../php/tasks.php" style="color:peru">Tasks</a></li>
                    <li><a href="../includes/logout_inc.php">Log Out</a></li>
                </ul>
            </nav>
<div class="container">
<form action="../includes/tasks_inc.php" method="post">
<input type="text" name="taskmsg" id="taskmsg">
<input type="submit" id="addtask" name= "addtask" value="Add Task">
</form>
<?php
    require_once "../includes/connection_inc.php";
    $sql = 'SELECT * FROM tasks WHERE DesignerID = ?';       //Default status = undone
    $stmt = $conn->prepare($sql);
    
    if(!$stmt) {      //Differenet because we are on the same page [Could add a div error element]
        echo "Something went wrong!";
    }

    $stmt->execute([$_SESSION["userID"]]);
    echo '<div class="tasks">';

    if($stmt->rowCount() > 0) {
        
        while($row = $stmt->fetch()) {
            echo '<div id="task">';
            echo $row["TaskMessage"].' 
            <form action="../includes/tasks_inc.php" method="post">
                <input type="number" name="taskid" id="taskid" value="' . $row["TaskID"] .'">
                <button name="delete" type="submit">Delete</button>
            </form>
            <br>
            <br>
            <br>';
            echo '</div>';
        }
        
    } else {
        echo 'You have no pending tasks!';
    }

    echo '</div>
            </div>
    ';
?> 

</body>
</html>


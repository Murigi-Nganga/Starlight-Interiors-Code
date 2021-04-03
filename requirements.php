<?php 
    include_once "header.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Requirements</title>
</head>
<body>
    <p>Thank you for choosing us!</p>
    <form action="includes/requirements_inc.php" method="POST" enctype="multipart/form-data">
        Type of Room: <br>
        <input type="text" name="roomtype" id="roomtype"> <br>
        <br> Room Measurements: <br> 
        <input type="text" name="measurements" id="measurements"> <br>
        <br> Preferred Materials: <br>
        <input type="radio" name="materials" id="materials"> <br>
        <br> Some of the colors you like? <br>
        <input type="color" name="collike1" id="collike1">
        <input type="color" name="collike2" id="collike2">
        <input type="color" name="collike3" id="collike3">
        <br> Some of the colors you dislike? <br>
        <input type="color" name="colnotlike1" id="colnotlike1">
        <input type="color" name="colnotlike2" id="colnotlike2">
        <input type="color" name="colnotlike3" id="colnotlike3">
        <br> Is there furniture or other decor that you would like to keep? <br>
        <textarea name="decortokeep" id="decortokeep" cols="30" rows="10"></textarea>
        <br> What do you dislike about this room? <br>
        <textarea name="roomdislikes" id="roomdislikes" cols="30" rows="10"></textarea>
        <br> Some images of vision <br>
        <textarea name="roominspo" id="roominspo" cols="30" rows="10"></textarea>
        <br> Room Image: <br>
        <input type="file" name="roomimg" id="roomimg">
        <br> Are there any special family needs that should be considered? <br>
        <textarea name="roominspo" id="roominspo" cols="30" rows="10"></textarea>
        <br> <br> <input type="submit" value="Submit"> <br> 
    </form>

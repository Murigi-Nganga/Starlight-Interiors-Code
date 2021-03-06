<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/requirements.css">
    <script defer src="../js/requirements.js"></script>
    <title>Interior Design Management System</title>
</head>
<body>
    <nav id= 'nav'>
        <div class="logo">
            <img src="../images/logo.png" alt="Image of a camel">
        </div>
        <div class="coname">
            Starlight Interiors
        </div>
        <ul>
        <li><a href="../php/notifications.php"style="color:peru"><img src="../images/MessagesBell.png" alt="No messages Notification Bell"></a></li>
            <li><a href="../php/index.php">Home</a></li>
            <li><a href="../php/requirements.php" style="color:peru">Requirements</a></li>
            <li><a href="../php/drawings.php">Drawings</a></li>
            <li><a href="../php/payments.php">Payments</a></li>
            <li><a href="../includes/logout_inc.php">Log Out</a></li>
        </ul>
    </nav>

    
        <?php
            if(isset($_GET['error']) && $_GET['error'] === 'none') {
                    echo '<script>alert("Your specification has been submitted successfully!")</script>';
            }
        ?>
    <div id='display-errors'></div>
	<div class="formarea">
        <h1 style="text-align: center; font-weight:bolder; font-size:21px; text-decoration:underline;">Requirements Specification</h1>
        <br><br>

    <form id='reqform' name='reqform'  action="../includes/requirements_inc.php" method="POST" enctype="multipart/form-data">
        <label for="typeofroom">1. Enter the type of room</label> <br>
		<input id="typeofroom" type="text" name="typeofroom" > <br>

        <label for="roompic">2. Upload a picture of the room:</label> <br>
		<input id="roompic" type="file" name="roompic"  > <br>
		
        <label for="approxsize">3. Enter the approximate size of the room in meters: <br>
        <span  style="color:rgb(66,73,73);">  <!--Could include the floor plan instead of asking for the approximate size-->
            eg: 2m by 1m
        </span></label> <br>
		<input id="approxsize" type="text" name="approxsize" > <br>

        <label for="roompic">4. Enter three of your favorite colors:</label>
        <span  style="color:rgb(66, 73, 73);">
            eg: bisque, orange, beige
        </span> <br>
		<input id="colors" type="text" name="colors" > <br>
		
        <label for="roompic"> <br>
            5. Enter two colors that you dislike:
        </label>
        <span  style="color:rgb(66,73,73);"> 
            eg: bisque, orange
        </span> <br>
		<input id="discolors" type="text" name="discolors" >   <!--Could have options to have a color picker-->
		<br>
        <label for="floortype"> <br>
            6. Which kind of floor would you prefer to have:
        </label> <br>
		<select id="floortype" name="floortype" >
			<option>Wooden</option>
			<option>Cemented</option>
			<option>Tiled</option>
            <option>Natural Stone</option>
            <option>Maintain the one I have</option>
		</select>
        <br>
        <label for="wallcovering"> <br>
            7. What type of wall covering would you like to have:
        </label> <br>
        <select id="wallcovering" name="wallcovering" >
			<option>Painted</option>
			<option>Wall paper</option>
			<option>Tiled</option>
            <option>Natural Stone</option>
            <option>Maintain the one I have</option>
		</select> <br>
        <label for="inspopic"> <br>
            8. Upload a picture of what you would want your room to look like: 
        </label> 
        <span  style="color:rgb(66,73,73);">
            (An inspiration image):
        </span> <br>
		<input id="inspopic" type="file" name="inspopic" >
        <br>
        <label for="specialneeds"> <br>
            9. Any special family needs that need to be considered: 
        </label>
        <span  style="color:rgb(66,73,73);">
            (Allergies to materials, aged loved ones, disabled persons etc)
        </span> <br>
		<input id="specialneeds" type="text" name="specialneeds">
        <br>
        <label for="budget"> <br>
        10. Your budget in Kenya Shillings:
        </label> <br>
		<input id="budget" type="text" name="budget" >
        <br>
        <label for="anyotherinfo"> <br>
            11. Any other information you would like us to be aware of: 
        </label> <br>
		<input id="" name="anyotherinfo" type="text" name="anyotherinfo" >
        <br> <br>
        <button id="submit-req" name="submit-req" type='submit' >Submit Specification</button>
    </form>
    </div>

  <!-- Footer -->
  <section id="footer">
    <div class="footer container">
      <div class="social-icon">
        <div class="social-item">
          <!--We are Social ????</h3-->
          <a href="https://www.google.com" target="_blank"><img src="../images/gp.png"/></a>
        </div>
        <div class="social-item">
          <a href="https://www.facebook.com" target="_blank"><img src="../images/fb.png"/></a>
        </div>
        <div class="social-item">
          <a href="https://www.twitter.com" target="_blank"><img src="../images/tw.png"/></a>
        </div>
      </div>
      <p>Copyright ?? 2021 Starlight Interiors. All rights reserved</p>
    </div>
  </section>
  <!-- End Footer -->

</body>
</html>
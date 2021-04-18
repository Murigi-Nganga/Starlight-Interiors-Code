<?php
	session_start();

    if(isset($_SESSION["userID"])) {
		if($_SESSION["role"] === "client" || $_SESSION["role"] === "admin") {
			include_once "../html/header_in.html";
		} else {
			include_once "../html/designer_in.html";
		} 
	}
	
	else {
    	include_once "../html/header_out.html";
  	}
  	include "../html/home_body.html";
	  //print_r($_SESSION)
?>
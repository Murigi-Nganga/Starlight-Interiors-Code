<?php
	session_start();
	if (isset($_SESSION["IdNumber"])) {
    	include_once "../html/header_in.html";
  	} else {
    	include_once "../html/header_out.html";
  	}
  	include "../html/home_body.html";
?>
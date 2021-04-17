<?php
	session_start();
	if (isset($_SESSION["ClientID"]) || isset($_SESSION["AdminID"])) {
    	include_once "../html/header_in.html";
  	} elseif (isset($_SESSION["DesignerID"])) {
		include_once "../html/designer_in.html";
	} else {
    	include_once "../html/header_out.html";
  	}
  	include "../html/home_body.html";
?>
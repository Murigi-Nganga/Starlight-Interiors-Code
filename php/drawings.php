<?php
    session_start();
    if($_SESSION["role"] === 'client') {
        include_once "../html/drawings.html";  //Client's Drawings' Page
    } elseif($_SESSION["role"] === 'designer') {
        
    }
?>
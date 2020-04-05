<?php

session_start();

// logs out the user 
session_destroy();

// takes the user to the main page where they can log in again 
header("location:index.php");

?>
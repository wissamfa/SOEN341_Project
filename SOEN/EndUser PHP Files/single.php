<!DOCTYPE html>

<?php

session_start();

// allows us to access the variables we created in the header file 
include("includes/header.php");

// allows us to directly go to the main page when we run our localhost 
if(!isset($_SESSION['user_email'])){
	header("location: index.php");
}
?>


<html>
    <head>
        <title>View Your Post</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <link rel="stylesheet" type="text/css" href="style/home_style2.css">
    </head>
    <body>

        <div class="row">
            <div class="col-sm-12">
                <!-- This wil represent the comment section-->
                <center><h2>Comments</h2></center>
                <!-- Add a functionality for the view button in the profile page -->
                <?php single_post();?>
            </div>
        </div>

    </body>
</html>

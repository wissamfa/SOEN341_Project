<!DOCTYPE html>

<?php

session_start();

// allows us to access the variables we created in the header file 
include("includes/header.php");
?>
<?php

// allows us to directly go to the main page when we run our localhost 
if(!isset($_SESSION['user_email'])){

	header("location: index.php");

}
else{  // else starts here ?>
<html>
    <head>
        <title>Search Results</title>
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
                <center><h2>Your Search Results</h2></center><br><br>
                <!-- adds the function of retrieving all the posts that are similar to the what the user searched from the database -->
                <?php results();?>
            </div>
        </div>
    </body>
</html>
<?php }   // else ends here?>

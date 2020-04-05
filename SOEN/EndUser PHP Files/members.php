<!DOCTYPE html>

<?php

session_start();

// allows us to access the variables we created in the header file 
include("includes/header.php");
?>


<?php

// if the user is not logged in, take them to the main page to log in or sign in 
if(!isset($_SESSION['user_email'])){

    header("location: index.php");
    
}

// if the user is logged in, take them to the "Find People" page 
else{ //else starts here?>

    <html>

        <head>
            <title>Find People</title>
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
                    <!-- Create a page where a user can search for other users-->
                    <center><h2>Find New People</h2></center><br><br>
                    <div class="row">
                        <div class="col-sm-4">
                        </div>
                        <div class="col-sm-4">
                            <form class="search_form" action="">
                                <input type="text" placeholder="Search Friends" name="search_user">
                                <button class="btn btn-info" type="submit" name="search_user_btn">Search</button>
                            </form>
                        </div>
                        <div class="col-sm-4">
                        </div>
                    </div><br><br>
                    <!-- Creates the functionaloty of the "Search Friend" button-->
                    <?php search_user();?>
                </div>
            </div>
        </body>
    </html>

    <?php }  //else ends here?>

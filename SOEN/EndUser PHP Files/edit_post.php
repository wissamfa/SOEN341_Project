<!DOCTYPE html>

<?php

session_start();

// allows us to access the variables we created in the header file 
include("includes/header.php");


// allows us to directly go to the main page when we run localhost 
if(!isset($_SESSION['user_email'])){
	header("location: index.php");
}

?>

<html>
    <head>
        <title>Edit Post</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <link rel="stylesheet" type="text/css" href="style/home_style2.css">
    </head>

    <body>

        <div class='row'>
            <div class="col-sm-3">
            </div>
            <div class="col-sm-6">
                <?php 

                    // get the post id ( the one i want to change ) from the website
                    if(isset($_GET['post_id'])){
                        $get_id =$_GET['post_id'];
                        
                        // accessing the database to get the post information 
                        $get_post = "SELECT * from posts where post_id='$get_id'";
                        $run_post = mysqli_query($con, $get_post);
                        $row = mysqli_fetch_array($run_post);

                        $post_con = $row['post_content'];
                    }
                ?>

                <!-- Creating the box and button where the user will edit the post -->
                <form action="" method="post" id="f">
                    <center><h2>Edit Your Post</h2></center><br>
                    <textarea class="form-control" cols="83" rows="4" name="content"><?php echo $post_con;?></textarea><br>
                    <input type="submit" name="update" value="Update Post" class="btn btn-info"/>
                </form>

                <?php

                    // get the post content from the website 
                    if(isset($_POST['update'])){
                        $content =$_POST['content'];

                        // update the old post content with the new post content
                        $update_post = "UPDATE posts set post_content='$content' where post_id='$get_id'";
                        $run_update = mysqli_query($con, $update_post);

                        // if content has been updated, show the user and take them to the home page 
                        if($run_update){
                            echo "<script>alert('The Post has been updated !!')</script>";
                            echo "<script>window.open('home.php', '_self')</script>";
                        }
                    }
                ?>
            </div>
            <div class="col-sm-3">
            </div>
        </div>

    </body>
</html>

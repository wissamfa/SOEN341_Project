<!DOCTYPE html>
<html>
    <head>
        <title>Forgot Password</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    </head>
    <style>

        /* remove the horizontal line scrolling of the page  */ 
        body{
            overflow-x: hidden;
        }

        /* Style for information asked from user */
        .main-content {
            width: 50%;
            height: 40%;
            margin: 10px auto;
            background-color: #fff;
            border: 2px solid #e6e6e6;
            padding: 40px 50px;
        }

        /* Style for header of the page*/
        .header {
            border: 0px solid #000;
            margin-bottom: 5px;
        }

        /* Style for top side fo page */
        .well{
            background-color: #187FAB;
        }

        /* Style for signup button */
        #signup{
            width: 60%;
            border-radius: 30px;
        }

    </style>

    <body>
        <div class="row">
            <div class="col-sm-12">
                <div class="well">
                    <center><h1 style="color: white;"><strong>TheGram</strong></h1></center>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="main-content">
                    <div class="header">
                        <h3 style="text-align: center;"><strong>Forgot Password.</strong></h3><hr>
                    </div>
                    <div class="l-part">
                        <form  action="" method="post">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <input id="email" type="text" class="form-control" name="email" placeholder="Enter Your Email" required="required">
                            </div><br>
                            <hr>
                            <!-- Ask the user to enter the answer of the security question-->
                            <pre class="text">What is your mother's maiden name ?</pre>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
                                <input id="msg" type="text" class="form-control" placeholder="Someone" name="recovery_account" required="required">
                            </div><br>
                            <a style="text-decoration:none;float: right; color:#187FAB;" data-toggle="tooltip" title="Signin"  href="signin.php">Back to Sign-in?</a><br><br>
                            <center><button id="signup" class="btn btn-info btn-lg" name="submit">Submit</button></center>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>

<?php

    session_start();

    // include the connection 
    include("includes/connection.php");

        // if the submit button is clicked
        if(isset($_POST['submit'])){

            // get the email and the recovery answer from the user input 
            $email = htmlentities(mysqli_real_escape_string($con,$_POST['email']));
            $recovery_account = htmlentities(mysqli_real_escape_string($con,$_POST['recovery_account']));

            // from these inputs, access the dataabse to check if that user exists 
            $select_user = "SELECT * from users where user_email='$email' AND recovery_account='$recovery_account'";
            $query = mysqli_query($con,$select_user);
            $check_user = mysqli_num_rows($query);

            // if the user exists, take them to the change password page 
            if($check_user==1){
                // get the email of the logged in user 
                $_SESSION['user_email']=$email;
                echo "<script>window.open('change_password.php','_self')</script>";
            }else{ // if the user doesnt exist then alert the user and refresh the page 
                echo "<script>alert('Incorrect Answer !!!')</script>";
                echo "<script>window.open('forgot_password.php','_self')</script>";
            }

        }


?>

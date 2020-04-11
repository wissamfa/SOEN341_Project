<!DOCTYPE html>
<?php
session_start();
include("includes/header.php");
?>
<?php

if(!isset($_SESSION['user_email'])){

	header("location: index.php");

}
else{ // else starts here ?>
<html>
    <head>

        <title>Messages</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <link rel="stylesheet" type="text/css" href="style/home_style2.css">
    </head>

    <style>

        /* style for the scrolling function of the user and the messages   */
        #scroll_messages{
            max-height: 500px;
            overflow: scroll;
        }

        /* style for the send button  */
        #btn-msg{
            width: 20%;
            height: 28px;
            border-radius: 5px;
            margin: 5px;
            border: none;
            color: #fff;
            float: right;
            background-color: #2ecc71;
        }

        /* style for the left side of the page ( the part where you select a user to talk to ) */
        #select_user{
            max-height: 500px;
            overflow:scroll;
        }

	    
        /* style for the blue messages ( from the sender */
        #green{
            background-color: #2ecc71;
            border-color: #27ae60;
            width:45%;
            padding:2.5px;
            font-size:16px;
            border-radius:3px;
            float: left;
            margin-bottom: 5px;
        }

        /* style for the green messages ( from the receiver ) */
        #blue{
            background-color: #3498db;
            border-color: #2980b9;
            width:45%;
            padding:2.5px;
            font-size:16px;
            border-radius:3px;
            float: right;
            margin-bottom: 5px;
        }
    </style>

    <body>
        <div class="row">
            <?php

                global $con;
            
                if(isset($_GET['u_id'])){                      
                    $get_id = $_GET['u_id'];        
                }

                if($get_id == "new"){

                }else{  // else 1 starts here 

                    //get the user id of the person i want to message from the URL
                    if(isset($_GET['u_id'])){
                    
                        // globalize the connection variable 
                        global $con;

                        $get_id = $_GET['u_id'];

                        // using that id, access the database and get the id and the username 
                        $get_user = "SELECT * from users where user_id='$get_id'";
                        $run_user = mysqli_query($con,$get_user);
                        $row_user = mysqli_fetch_array($run_user);

                        $user_to_msg = $row_user['user_id'];
                        $user_to_name = $row_user['user_name'];
                    }

                    // get the email of the person that is currently logged in 
                    $user = $_SESSION['user_email'];

                    // using that email access the database and get the id and the username
                    $get_user = "SELECT * from users where user_email='$user'";
                    $run_user = mysqli_query($con,$get_user);
                    $row=mysqli_fetch_array($run_user);

                    $user_from_msg = $row['user_id'];
                    $user_from_name = $row['user_name'];
                } // else 1 ends here
            ?>

            <!-- create a side box to show all the useer that we can message -->
            <div class="col-sm-3" id='select_user'>
                <?php

                    // using the email, access the database to get the user's information 
                    $user = "SELECT * from users";
                    $run_user = mysqli_query($con,$user);

                    while ($row_user=mysqli_fetch_array($run_user)){

                        $user_id = $row_user['user_id'];
                        $user_name = $row_user['user_name'];
                        $first_name = $row_user['f_name'];
                        $last_name = $row_user['l_name'];
                        $user_image = $row_user['user_image'];

                        echo"

                            <div class='container-fluid'>
                                <a style='text-decoration: none;cursor: pointer;color: #3897f0;' href='messages.php?u_id=$user_id'>
                                <img class='img-circle' src='users/$user_image' width='90px' height='80px' title='$user_name' /> <strong> &nbsp$first_name $last_name</strong><br><br>
                                </a>
                            </div>

                        ";
                    }
                ?>
            </div>

            <!-- display the user conversation , the text are, and the comment button -->
            <div class="col-sm-6">
                <div class="load_msg" id="scroll_messages">
                    <?php

                        global $con;
            
                        if(isset($_GET['u_id'])){                      
                            $get_id = $_GET['u_id'];        
                        }

                        if($get_id == "new"){

                        }else{ //else 2 starts here
                        // access the database from the messages table. look for all the messages that are by the sender and by the receiver 
                        $sel_msg = "SELECT * from user_messages where (user_to='$user_to_msg' AND user_from='$user_from_msg') OR (user_from='$user_to_msg' AND user_to='$user_from_msg') ORDER by 1 ASC";
                        $run_msg = mysqli_query($con,$sel_msg);

                        while($row_msg=mysqli_fetch_array($run_msg)){ // while starts here

                            $user_to = $row_msg['user_to'];
                            $user_from = $row_msg['user_from'];
                            $msg_body = $row_msg['msg_body'];
                            $msg_date = $row_msg['date'];
                        
                        
                    ?>

                            <div id="loaded_msg">
                                <p>
                                    <?php 
                                        // if the message is from the sender => make the message blue 
                                        if($user_to == $user_to_msg AND $user_from == $user_from_msg){
                                            echo "<div class='message' id='blue' data-toggle='tooltip' title='$msg_date'>$msg_body</div><br><br><br>";
                                        // if the message is from the receiver => make the message green    
                                        }else if($user_from == $user_to_msg AND $user_to==$user_from_msg){
                                            echo "<div class='message' id='green' data-toggle='tooltip' title='$msg_date'>$msg_body</div><br><br><br>";
                                        }
                                    ?>
                                </p>
                            </div>
                            <?php

                        } // while ends here
                    } // else 2 ends here

                            ?>
                </div>
                <?php

                    // get the id fromthe URL 
                    if(isset($_GET['u_id'])){
                        
                        $u_id = $_GET['u_id'];

                        // if the id is new, then ask the user to choose someone ( the id is new if the user still didnt choose who will they message )
                        if($u_id == "new"){
                            echo '

                                <form>
                                    <center><h3>Select Someone to start conversation</h3></center>
                                    <textarea disabled class="form-control" placeholder="Enter Your Message ... " id="message_textarea"></textarea>
                                    <input class="btn btn-default" disabled type="submit" name="send_msg" id="btn-msg" value="Send">
                                </form><br><br>

                            ';
                        }
                        else{
                            echo'
                                <form action="" method="POST">
                                    <textarea class="form-control" placeholder="Enter Your Message ... " name="msg_box" id="message_textarea"></textarea>
                                    <input type="submit" name="send_msg" id="btn-msg" value="Send">
                                </form><br><br>
                            ';
                        }
                    }
                ?>

                <?php

                    // if the send button is clicked 
                    if(isset($_POST['send_msg'])){

                        $msg = htmlentities($_POST['msg_box']);

                        // if the message is empty, we will show the user that the message was unable to send 
                        if($msg == ""){
                            echo"<h4 style='color:red;text-align:center;'>Message was unable to send!</h4>";
                        }
                        else{

                            // insert the message into the databse 
                            $insert = "INSERT into user_messages(user_to,user_from,msg_body,date,msg_seen) values ('$user_to_msg','$user_from_msg','$msg',NOW(),'no')";
                            $run_insert = mysqli_query($con,$insert);
                            echo"<script>window.open('messages.php?u_id=$user_to','_self')</script>";

                        }
                    }
                ?>
            </div>

            <!-- show the user information that we are talking with on the right side of the page -->
            <div class="col-sm-3">
                <?php

                    global $con;
                                
                    if(isset($_GET['u_id'])){                      
                        $get_id = $_GET['u_id'];        
                    }

                    if($get_id == "new"){

                    }else{ // else 3starts here

                    if(isset($_GET['u_id'])){

                        global $con;

                        $get_id = $_GET['u_id'];

                        $get_user = "SELECT * from users where user_id='$get_id'";
                        $run_user = mysqli_query($con,$get_user);
                        $row=mysqli_fetch_array($run_user);

                        $user_id = $row['user_id'];
                        $user_name = $row['user_name'];
                        $f_name = $row['f_name'];
                        $l_name = $row['l_name'];
                        $describe_user = $row['describe_user'];
                        $user_country = $row['user_country'];
                        $user_image = $row['user_image'];
                        $register_date = $row['user_reg_date'];
                        $gender = $row['user_gender'];
                    }

                        echo "
                            <div class='row'>
                                <div class='col-sm-2'>
                                </div>
                                <center>
                                    <div style='background-color: #e6e6e6;' class='col-sm-9'>
                                        <h2>Information about</h2>
                                        <img class='img-circle' src='users/$user_image' width='150' height='150' />
                                        <br><br>
                                        <ul class='list-group'>
                                            <li class='list-group-item' title='Username'><strong>$f_name $l_name</strong></li>
                                            <li class='list-group-item' title='User Status'><strong style='color:grey;'>$describe_user</strong></li>
                                            <li class='list-group-item' title='Gender'>$gender</li>
                                            <li class='list-group-item' title='Country'>$user_country</li>
                                            <li class='list-group-item' title='User Registration Date'>$register_date</li>
                                        </ul>
                                    </div>
                                </center>
                                <div class='col-sm-1'>
                                </div>
                            </div>
                            ";
                    } // else 3 ends here
                ?>
            </div>
        </div>

        <script>

            // automatically scroll down to the latest messages 
            var div = document.getElementById("scroll_messages");
            div.scrollTop = div.scrollHeight;

        </script>

    </body>
</html>

<?php } // else ends here?>

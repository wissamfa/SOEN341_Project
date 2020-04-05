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

else{ // else 1 starts here?>

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

    <style>

    /* style for the post section in the find friend page */
    #own_posts{
        border: 5px solid #e6e6e6;
        padding: 40px 50px;
        width:90%;
    }

    /* style for the post section in the find friend page */
    #posts_img {
        height:300px;
        width:100%;
    }

    </style>

    <body>

        <div class="row">

            <?php

                global $con;

                // get the user id from the URL
                if(isset($_GET['u_id'])){
                $u_id = $_GET['u_id'];
                }

                // if the user id is empty or negative number, take the user to the home page 
                if($u_id < 0 OR $u_id == ""){
                    echo"<script>window.open('home.php','_self')</script>";
                }else
                { //else 2 starts here

            ?>



            <div class="col-sm-12">

                <?php

                    // get the user if from the URL 
                    if(isset($_GET['u_id'])){

                    // globalize the connection variable 
                    global $con;

                    $user_id = $_GET['u_id'];

                    // access the database using the user id  to get the username of the user 
                    $select = "SELECT * from users where user_id='$user_id'";
                    $run = mysqli_query($con,$select);
                    $row=mysqli_fetch_array($run);

                    $name = $row['user_name'];
                    }

                ?>

                <!-- When the user clicks on someone else's username, get the information of the 2nd user to show the first user -->
                <?php

                    // get the id from the URL ( the user we clicked on )
                    if(isset($_GET['u_id'])){

                        global $con;

                        $user_id = $_GET['u_id'];

                        // access the database using the id to get all the other information of the 2nd user 
                        $select = "SELECT * from users where user_id='$user_id'";
                        $run = mysqli_query($con,$select);
                        $row=mysqli_fetch_array($run);

                        $id = $row['user_id'];
                        $image = $row['user_image'];
                        $name = $row['user_name'];
                        $f_name = $row['f_name'];
                        $l_name = $row['l_name'];
                        $describe_user = $row['describe_user'];
                        $country = $row['user_country'];
                        $gender = $row['user_gender'];
                        $register_date = $row['user_reg_date'];



                        // get the email fo the user that is currently logged in 
                        $user = $_SESSION['user_email'];

                        // using that email, access the database to get the user id, name, and images 
                        $get_user = "SELECT * from users where user_email='$user'";
                        $run_user = mysqli_query($con,$get_user);
                        $row=mysqli_fetch_array($run_user);

                        $userown_id = $row['user_id'];
                        $user_name = $row['user_name'];
                        $user_image = $row['user_image'];

                        // if the id of the clicked user = the id opf the curretnly logged in user, show them the edit profile button 
                        if($user_id == $userown_id){
                            echo"<script>window.open('profile.php?u_id=$user_id','_self')</script>";                       
                        }else{

                            
                            // we need to display the information of user 2 to user 1 
                            echo"
                                <div class='row'>
                                    <div class='col-sm-1'>
                                    </div>
                                    <center>
                                        <div style='background-color: #e6e6e6;' class='col-sm-3'>
                                            <h2>Information about</h2>
                                            <img class='img-circle' src='users/$image' width='150' height='150' />
                                            <br><br>
                                            <ul class='list-group'>
                                                <li class='list-group-item' title='Username'><strong>$f_name $l_name</strong></li>
                                                <li class='list-group-item' title='User Status'><strong style='color:grey;'>$describe_user</strong></li>
                                                <li class='list-group-item' title='Gender'>$gender</li>
                                                <li class='list-group-item' title='Country'>$user_country</li>
                                                <li class='list-group-item' title='User Registration Date'>$register_date</li>
                                            </ul>
                                            <input type='button' class='btn btn-info btn-info' name='follow_user' onclick='' value='Follow' />
                                            <br><br>                                      
                            ";

                            // <a href='user_profile.php?u_id=$user_id' class='btn btn-success'/>Follow</a><br><br><br>

                            if(isset($_POST['follow_user'])){




                                echo"
                                        </div>
                                    </center>  
                                ";

                            }else{

                                echo"
                                        </div>
                                    </center>  
                                ";
                            }
                        }
                    }

                ?>

                <div class='col-sm-8'>

                    <!-- Here we want to display all the posts the user we clicked on posted  --> 
                    <center><h1><strong><?php echo "$f_name $l_name's"; ?></strong> Posts</h1></center>

                    <?php

                        global $con;

                        // get the id from the URL ( its the id of the person we clicked on )
                        if(isset($_GET['u_id'])){
                        $u_id = $_GET['u_id'];
                        }

                        // the number of posts that will be shown in each page
                        $per_page = 5;

                        // if the user changes the page, then display that page, otherwise display page 1 
                        if(isset($_GET['page'])){
                            $page = $_GET['page'];
                        }else{
                            $page=1;
                        }

                        $start_from = ($page-1) * $per_page;

                        // using that id , access the database and get information of the user 
                        $get_posts = "SELECT * from posts where user_id='$u_id' ORDER by 1 DESC LIMIT $start_from, $per_page";
                        $run_posts = mysqli_query($con,$get_posts);


                        while($row_posts=mysqli_fetch_array($run_posts)){

                            $post_id = $row_posts['post_id'];
                            $user_id = $row_posts['user_id'];
                            $content = $row_posts['post_content'];
                            $upload_image = $row_posts['upload_image'];
                            $post_date = $row_posts['post_date'];

                            //getting the user who has posted the thread

                            $user = "SELECT * from users where user_id='$user_id' AND posts='yes'";

                            $run_user = mysqli_query($con,$user);
                            $row_user=mysqli_fetch_array($run_user);

                            $user_name = $row_user['user_name'];
                            $f_name = $row_user['f_name'];
                            $l_name = $row_user['l_name'];
                            $user_image = $row_user['user_image'];


                            
                            // if the post contains only an image with no description     
                            if($content=="No" && strlen($upload_image) >= 1){

                                echo "
                                    <div id='own_posts'>
                                        <div class='row'>
                                            <div class='col-sm-2'>
                                                <p><img src='users/$user_image' class='img-circle' width='100px' height='100px'></p>
                                            </div>
                                            <div class='col-sm-6'>
                                                <h3><a style='text-decoration: none;cursor: pointer;color: #3897f0;' href='user_profile.php?u_id=$user_id'>$f_name $l_name <h6>( $user_name )</h6></a></h3>
                                                <h4><small style='color:black;'>Updated a post on <strong>$post_date</strong></small></h4>
                                            </div>
                                            <div class='col-sm-4'>
                                            </div>
                                        </div>
                                        <div class='row'>
                                            <div class='col-sm-12'>
                                                <img id='posts-img' src='imagepost/$upload_image' style='height:350px;'>
                                            </div>
                                        </div><br>
                                        <a href='single.php?post_id=$post_id' style='float:right;'><button class='btn btn-success'>View</button></a>
                                    </div><br/><br/>
                                ";

                            }

                            // if the post contains both an image and a description 
                            else if(strlen($content) >= 1 && strlen($upload_image) >= 1){

                                echo "
                                    <div id='own_posts'>
                                        <div class='row'>
                                            <div class='col-sm-2'>
                                                <p><img src='users/$user_image' class='img-circle' width='100px' height='100px'></p>
                                            </div>
                                            <div class='col-sm-6'>
                                                <h3><a style='text-decoration: none;cursor: pointer;color: #3897f0;' href='user_profile.php?u_id=$user_id'>$f_name $l_name <h6>( $user_name )</h6></a></h3>
                                                <h4><small style='color:black;'>Updated a post on <strong>$post_date</strong></small></h4>
                                            </div>
                                            <div class='col-sm-4'>

                                            </div>
                                        </div>
                                        <div class='row'>
                                            <div class='col-sm-12'>
                                                <p>$content</p>
                                                <img id='posts-img' src='imagepost/$upload_image' style='height:350px;'>
                                            </div>
                                        </div><br>
                                        <a href='single.php?post_id=$post_id' style='float:right;'><button class='btn btn-success'>View</button></a>
                                    </div><br/><br/>
                                ";

                            }

                            // if the post contains only text
                            else{

                                echo "
                                    <div id='own_posts'>
                                        <div class='row'>
                                            <div class='col-sm-2'>
                                                <p><img src='users/$user_image' class='img-circle' width='100px' height='100px'></p>
                                            </div>
                                            <div class='col-sm-6'>
                                                <h3><a style='text-decoration: none;cursor: pointer;color: #3897f0;' href='user_profile.php?u_id=$user_id'>$f_name $l_name <h6>( $user_name )</h6></a></h3>
                                                <h4><small style='color:black;'>Updated a post on <strong>$post_date</strong></small></h4>
                                            </div>
                                            <div class='col-sm-4'>

                                            </div>
                                        </div>
                                        <div class='row'>
                                            <div class='col-sm-12'>
                                                <h3><p>$content</p></h3><br>
                                            </div>
                                        </div><br>
                                        <a href='single.php?post_id=$post_id' style='float:right;'><button class='btn btn-info'>Comment</button></a><br>
                                    </div><br><br>
                                ";

                            }
                        }
                        // Divides how the posts will be posted in the pages and link to the pages  
                        include("functions/pagination_user_profile.php");

                    ?>

                </div>

            </div>
        </div>

        <?php } //else 2 ends here ?>

    </body>

</html>

<?php } //else 1 ends here ?>

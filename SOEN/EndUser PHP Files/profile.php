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

    <!-- The title of the profile page will be the name of the user -->
	<!-- php is used to fetch the name of the user from the database -->
	<?php
		$user = $_SESSION['user_email'];
		$get_user = "SELECT * from users where user_email='$user'";
		$run_user = mysqli_query($con,$get_user);
		$row = mysqli_fetch_array($run_user);

		$user_name = $row['user_name'];
	?>


	<title><?php echo "$user_name"; ?></title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="style/home_style2.css">
</head>
<style>

    /* Style for background image of the user*/
	#cover-img{
		height: 400px;
		width: 100%;
	}
    /* Style for profile image of the user*/
    #profile-img{
		position: absolute;
		top: 160px;
		left: 40px;
	}

    /* Style for select profile button of the page*/
	#update_profile{
		position: relative;
		top: -33px;
		cursor: pointer;
		left: 93px;
		border-radius: 4px;
		background-color: rgba(0,0,0,0.1);
		transform: translate(-50%, -50%);
	}

    /* Style for update profile button of the page*/
	#button_profile{
		position: absolute;
		top: 82%;
		left: 50%;
		cursor: pointer;
		transform: translate(-50%, -50%);
	}

    /* Style for update profile button of the page*/
	#own_posts{
		border: 5px solid #e6e6e6;
		padding: 40px 50px;
	}

	/* Style for images being posted on the page*/
	#posts-img{
		height: 300px;
		width: 100%;
	}

</style>


<body>

    <div class="row">
        <!-- Leaving this div empty will result in a white space from the left side of the page--> 
        <div class="col-sm-2">	
        </div>

        <div class="col-sm-8">

            <!-- The 1st div tag is used to create and allow  the user to post/change a background ( cover ) picture for his profile -->
			<!-- The 2nd div tag is used to create and allow  the user to post/change a profile picture for his profile -->
            <?php
                echo"
                <div>
                    <div><img id='cover-img' class='img-rounded' src='cover/$user_cover' alt='cover'></div>
                    <form action='profile.php?u_id=$user_id' method='post' enctype='multipart/form-data'>

                    <ul class='nav pull-left' style='position:absolute;top:10px;left:40px;'>
                        <li class='dropdown'>
                            <button class='dropdown-toggle btn btn-default' data-toggle='dropdown'>Change Cover</button>
                            <div class='dropdown-menu'>
                                <center>
                                <p>Click <strong>Select Cover</strong> and then click the <br> <strong>Update Cover</strong></p>
                                <label class='btn btn-info'> Select Cover
                                <input type='file' name='u_cover' size='60' />
                                </label><br><br>
                                <button name='submit' class='btn btn-info'>Update Cover</button>
                                </center>
                            </div>
                        </li>
                    </ul>

                    </form>
                </div>
                <div id='profile-img'>
                    <img src='users/$user_image' alt='Profile' class='img-circle' width='180px' height='185px'>
                    <form action='profile.php?u_id='$user_id' method='post' enctype='multipart/form-data'>
                        <label id='update_profile'> Select Profile
                            <input type='file' name='u_image' size='60' />
                        </label><br><br>
                        <button id='button_profile' name='update' class='btn btn-info'>Update Profile</button>
                    </form>
                </div><br>
                ";
            ?>

            <?php

                // allow the user to upload and update an their cover picture when the "update cover" button is clicked, 
                if(isset($_POST['submit'])){

                    $u_cover = $_FILES['u_cover']['name'];
                    $image_tmp = $_FILES['u_cover']['tmp_name'];
                    // generate a random number ; the random number is used to make the pictures uploaded to be unique 
                    $random_number = rand(1,10000);

                    // if the user doesnt select an iamage, refresh the page 
                    if($u_cover==''){
                        echo "<script>alert('Please Select Cover Image')</script>";
                        echo "<script>window.open('profile.php?u_id=$user_id' , '_self')</script>";
                        exit();

                    }else{ // if an image is chosen 

                        // save the chosen image with the random number added to its name in the cover directory 
                        move_uploaded_file($image_tmp, "cover/$u_cover.$random_number");

                        // storing the post in database and connecting it to the user id it is being saved from 
                        $update = "update users set user_cover='$u_cover.$random_number' where user_id='$user_id'";
                        $run = mysqli_query($con, $update);

                        // if the image was posted properly in the database, refresh the page 
                        if($run){
                        echo "<script>alert('Your Cover Updated')</script>";
                        echo "<script>window.open('profile.php?u_id=$user_id' , '_self')</script>";
                        }
                    }

                }

            ?>
        </div>


        <?php

            // allow the user to upload and update an their profile picture when the "update profile" button is clicked,
            if(isset($_POST['update'])){

                // storing the image the user chose in a variable
                $u_image = $_FILES['u_image']['name'];
                $image_tmp = $_FILES['u_image']['tmp_name'];
                // generate a random number ; the random number is used to make the pictures uploaded to be unique 
                $random_number = rand(1,10000);

                // if the user doesnt select an iamage, refresh the page 
                if($u_image==''){
                    echo "<script>alert('Please Select Profile Image on clicking on your profile image')</script>";
                    echo "<script>window.open('profile.php?u_id=$user_id' , '_self')</script>";
                    exit();
                }else{ // if an image is chosen 

                    // save the chosen image with the random number added to its name in the users directory 
                    move_uploaded_file($image_tmp, "users/$u_image.$random_number");

                    // storing the post in database and connecting it to the user id it is being saved from 
                    $update = "UPDATE users set user_image='$u_image.$random_number' where user_id='$user_id'";
                    $run = mysqli_query($con, $update);

                    // if the image was posted properly in the database, refresh the page 
                    if($run){
                    echo "<script>alert('Your Profile Updated')</script>";
                    echo "<script>window.open('profile.php?u_id=$user_id' , '_self')</script>";
                    }
                }

            }
        ?>

        <!-- Leaving this div empty will result in a white space from the left side of the page-->
        <div class="col-sm-2">
        </div>
    </div>

    <div class="row">
        <!-- Leaving this div empty will result in a white space from the left side of the page--> 
        <div class="col-sm-2">
        </div>

        <div class="col-sm-2" style="background-color: #e6e6e6;text-align: center;left: 0.6%;border-radius: 5px;">

              <!-- Shows the About section of the profile page => shows the information of the user -->
            <?php

            echo"
                <center><h2><strong>About</strong></h2></center>
					<center><h4><strong>$first_name $last_name</strong></h4></center>
					<center><h5><strong>$user_name</strong></h4></center>
					<p><strong><i style='color:grey;'>$describe_user</i></strong></p><br>
					<p><strong>Relationship Status: </strong> $Relationship_status</p><br>
					<p><strong>Lives In: </strong> $user_country</p><br>
					<p><strong>Member Since: </strong> $register_date</p><br>
					<p><strong>Gender: </strong> $user_gender</p><br>
					<p><strong>Date of Birth: </strong> $user_birthday</p><br>
            ";
            ?>
        </div>


        <!----------------------------------------------------------------- Display the user's post -------------------------------------------------------------------------->

        <div class="col-sm-6">

            <?php

				global $con;

				// get the user id so we can specifically choose which posts to post on the profile page 
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

				// access the database to get the posts ( only the ones with the same user_id ) from newest to oldest post 
				$get_posts = "SELECT * from posts where user_id='$u_id' ORDER by 1 DESC LIMIT $start_from, $per_page";
                $run_posts = mysqli_query($con, $get_posts);
                

                // retrieve the data ( only the ones with the same user_id ) and store them in the appropriate variable then post them 
				while($row_posts = mysqli_fetch_array($run_posts)){
                                         
                    // get the user's email from the database 
                    $get_posts = "SELECT user_email from users where user_id='$u_id'";
                    $run_user = mysqli_query($con, $get_posts);
                    $row = mysqli_fetch_array($run_user);

                    $user_email = $row['user_email'];

                    // get the email of the user that is currently logged in 
                    $user = $_SESSION['user_email'];

                    // get the userr if of the user that is currently logged in 
                    $get_user = "SELECT * from users where user_email='$user'";
                    $run_user = mysqli_query($con, $get_user);
                    $row = mysqli_fetch_array($run_user);

                    $user_id = $row['user_id'];
                    $u_email = $row['user_email'];

                    // if the currently logged in user email doesnt match the user email shown by the website, send an alert and refresh the page 
                    if($u_email != $user_email){
                        echo"<script>alert('Security Breach !!!')</script>";
                        echo"<script>window.open('profile.php?u_id=$user_id','_self')</script>";
                    }else{
                        
                        $post_id = $row_posts['post_id'];
                        $user_id = $row_posts['user_id'];
                        $content = $row_posts['post_content'];
                        $upload_image = $row_posts['upload_image'];
                        $post_date = $row_posts['post_date'];
    
                        $user ="SELECT * from users where user_id='$user_id' AND posts='yes'";
    
                        $run_user = mysqli_query($con, $user);
                        $row_user = mysqli_fetch_array($run_user);
    
                        $user_name = $row_user['user_name'];
                        $user_image = $row_user['user_image'];
                        $first_name = $row_user['f_name'];
                        $last_name = $row_user['l_name'];


                        // if the post contains only an image with no description 
                        if($content == "No" && strlen($upload_image) >= 1){
                            echo"
                                
                                <div id='own_posts'>
                                    <div class='row'>
                                        <div class='col-sm-2'>
                                            <p><img src='users/$user_image' class='img-circle' width='100px' height='100px'></p>
                                        </div>
                                        <div class='col-sm-6'>
                                            <h3><a style='text-decoration:none; cursor:pointer;color #3897f0;' href='user_profile.php?u_id=$user_id'>$first_name $last_name <h6>( $user_name )</h6></a></h3>
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
                                    <a href='edit_post.php?post_id=$post_id' style='float:right;'><button class='btn btn-info'>Edit</button></a>
                                    <a href='functions/delete_post.php?post_id=$post_id' style='float:right;'><button class='btn btn-danger'>Delete</button></a>
                                </div><br><br>		

                            ";
                        }

                        // if the post contains both an image and a description
                        else if(strlen($content) >= 1 && strlen($upload_image) >= 1){
                            echo"
                                
                                <div id='own_posts'>
                                    <div class='row'>
                                        <div class='col-sm-2'>
                                            <p><img src='users/$user_image' class='img-circle' width='100px' height='100px'></p>
                                        </div>
                                        <div class='col-sm-6'>
                                            <h3><a style='text-decoration:none; cursor:pointer;color #3897f0;' href='user_profile.php?u_id=$user_id'>$first_name $last_name <h6>( $user_name )</h6></a></h3>
                                            <h4><small style='color:black;'>Updated a post on <strong>$post_date</strong></small></h4>
                                        </div>
                                        <div class='col-sm-4'>
                                        </div>
                                    </div>
                                    <div class='row'>
                                        <div class='col-sm-12'>
                                            <h4><p>$content</p></h4>
                                            <img id='posts-img' src='imagepost/$upload_image' style='height:350px;'>
                                        </div>
                                    </div><br>
                                    <a href='single.php?post_id=$post_id' style='float:right;'><button class='btn btn-success'>View</button></a>
                                    <a href='edit_post.php?post_id=$post_id' style='float:right;'><button class='btn btn-info'>Edit</button></a>
                                    <a href='functions/delete_post.php?post_id=$post_id' style='float:right;'><button class='btn btn-danger'>Delete</button></a>
                                </div><br><br>
                                                                                
                            ";
                        }

                        // if the post contains only text
                        else{
                            echo"
                                
                                <div id='own_posts'>
                                    <div class='row'>
                                        <div class='col-sm-2'>
                                            <p><img src='users/$user_image' class='img-circle' width='100px' height='100px'></p>
                                        </div>
                                        <div class='col-sm-6'>
                                            <h3><a style='text-decoration:none; cursor:pointer;color #3897f0;' href='user_profile.php?u_id=$user_id'>$first_name $last_name <h6>( $user_name )</h6></a></h3>
                                            <h4><small style='color:black;'>Updated a post on <strong>$post_date</strong></small></h4>
                                        </div>
                                        <div class='col-sm-4'>
                                        </div>
                                    </div>
                                    <div class='row'>
                                        <div class='col-sm-12'>
                                            <h4><p>$content</p></h4>
                                        </div>
                                    </div><br>    
                                    <a href='single.php?post_id=$post_id' style='float:right;'><button class='btn btn-success'>View</button></a>
                                    <a href='edit_post.php?post_id=$post_id' style='float:right;'><button class='btn btn-info'>Edit</button></a>
                                    <a href='functions/delete_post.php?post_id=$post_id' style='float:right;'><button class='btn btn-danger'>Delete</button></a>
                                </div><br><br>                        
                                                                                        
                            ";
                            
                        }

                        // adds the functionality for the delete button 
                        include("functions/delete_post.php");
                    }
               
                } 

                // Divides how the posts will be posted in the pages and link to the pages  
	            include("functions/pagination_profile.php");

            ?>

        </div>   
        <div class="col-sm-2">;  
        </div> 
    </div>
</body>
</html>

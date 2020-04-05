<?php

// allow us to connect to the database
$con = mysqli_connect("localhost","root","","social_network") or die("Connection was not established");


//function for inserting post
function insertPost(){

    // when the post button is clicked, post the picture in the home page 
	if(isset($_POST['sub'])){
        
        // so we can use the connection to database and the user id everywhere in this function
        global $con;
		global $user_id;

        // this will hold the content the user writes inside the box ( either just a text or a description to the picture ) ( up to 4 GB )
        $content = htmlentities($_POST['content']);
        
        // storing the image the user chose in a variable
		$upload_image = $_FILES['upload_image']['name'];
        $image_tmp = $_FILES['upload_image']['tmp_name'];

        // generate a random number ; the random number is used to make the pictures uploaded to be unique 
		$random_number = rand(1, 10000);


        // if the user inserts a text more than 4GB, show error and refresh the page
		if(strlen($content) > 4000000000){

			echo "<script>alert('Please Use 250 or less than 250 words!')</script>";
            echo "<script>window.open('home.php', '_self')</script>";
            
		}else{

            // if the user selects an image and writes a description
			if(strlen($upload_image) >= 1 && strlen($content) >= 1){
                // save the chosen image with the random number added to its name in the imagepost directory 
                move_uploaded_file($image_tmp, "imagepost/$upload_image.$random_number");
                // storing the image and description in the database
				$insert = "insert into posts (user_id, post_content, upload_image, post_date) values('$user_id', '$content', '$upload_image.$random_number', NOW())";
				$run = mysqli_query($con, $insert);

                // if the image was posted properly in the database ; refresh the page 
				if($run){
					echo "<script>alert('Your Post  is successful !!')</script>";
                    echo "<script>window.open('home.php', '_self')</script>";
                    
                    // update the database to " yes" => the user has a post under his ID 
					$update = "update users set posts='yes' where user_id='$user_id'";
					$run_update = mysqli_query($con, $update);
				}

                exit();
                
			}else{
                // if the user selects the post button without writing a post AND without chosing a picture, send the user an error and refresh the page 
				if($upload_image=='' && $content == ''){

					echo "<script>alert('Error Occured while uploading!')</script>";
                    echo "<script>window.open('home.php', '_self')</script>";
                    
				}else{

                    // if the user selects a picture but doesnt write a description
					if($content==''){

                        // save the chosen image with the random number added to its name in the imagepost directory 
                        move_uploaded_file($image_tmp, "imagepost/$upload_image.$random_number");

                        // storing the image and description in the database
						$insert = "insert into posts (user_id,post_content,upload_image,post_date) values ('$user_id','No','$upload_image.$random_number',NOW())";
						$run = mysqli_query($con, $insert);

                        // if the image was posted properly in the database ; refresh the page 
						if($run){
							echo "<script>alert('Your Post  is successful !!')</script>";
							echo "<script>window.open('home.php', '_self')</script>";

                            // update the database to " yes" => the user has a post under his ID
							$update = "update users set posts='yes' where user_id='$user_id'";
							$run_update = mysqli_query($con, $update);
						}

                        exit();
                        
					}else{ // if the user just writes a post without chosing a picture 

                        // storing the image and description in the database
						$insert = "insert into posts (user_id, post_content, post_date) values('$user_id', '$content', NOW())";
						$run = mysqli_query($con, $insert);

                        // if the post was posted properly in the database ; refresh the page 
						if($run){
							echo "<script>alert('Your Post  is successful !!')</script>";
                            echo "<script>window.open('home.php', '_self')</script>";
                            
                            // update the database to " yes" => the user has a post under his ID
							$update = "update users set posts='yes' where user_id='$user_id'";
							$run_update = mysqli_query($con, $update);
						}
					}
				}
			}
		}
	}
}



// get the posts from the database and display them under the news feed 
function get_posts(){

    // so we can use the connection to database and the user id everywhere in this function
    global $con;
    
    // the number of posts that will be shown in each page
	$per_page = 5;

    // if the user changes the page, then display that page, otherwise display page 1 
	if(isset($_GET['page'])){
		$page = $_GET['page'];
	}else{
		$page=1;
	}

	$start_from = ($page-1) * $per_page;

    // access the database to get the posts from newest to oldest post 
	$get_posts = "SELECT * from posts ORDER by 1 DESC LIMIT $start_from, $per_page";
	$run_posts = mysqli_query($con, $get_posts);

    // retrieve the data and store them in the appropriate variable then post them 
	while($row_posts = mysqli_fetch_array($run_posts)){

		$post_id = $row_posts['post_id'];
        $user_id = $row_posts['user_id'];
		$content = $row_posts['post_content'];
		$upload_image = $row_posts['upload_image'];
		$post_date = $row_posts['post_date'];

		$user = "SELECT * from users where user_id='$user_id' AND posts='yes'";
		$run_user = mysqli_query($con,$user);
		$row_user = mysqli_fetch_array($run_user);

		$user_name = $row_user['user_name'];
		$user_image = $row_user['user_image'];
		$first_name = $row_user['f_name'];
		$last_name = $row_user['l_name'];



		// if the post contains only an image with no description 
		if($content=="No" && strlen($upload_image) >= 1){
			echo"
			<div class='row'>
				<div class='col-sm-3'>
				</div>
				<div id='posts' class='col-sm-6'>
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
					<a href='single.php?post_id=$post_id' style='float:right;'><button class='btn btn-info'>Comment</button></a><br>
				</div>
				<div class='col-sm-3'>
				</div>
			</div><br><br>
			";
		}

        // if the post contains both an image and a description 
		else if(strlen($content) >= 1 && strlen($upload_image) >= 1){
			echo"
			<div class='row'>
				<div class='col-sm-3'>
				</div>
				<div id='posts' class='col-sm-6'>
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
					<a href='single.php?post_id=$post_id' style='float:right;'><button class='btn btn-info'>Comment</button></a><br>
				</div>
				<div class='col-sm-3'>
				</div>
			</div><br><br>
			";
		}

        // if the post contains only text 
		else{
			echo"
			<div class='row'>
				<div class='col-sm-3'>
				</div>
				<div id='posts' class='col-sm-6'>
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
					<a href='single.php?post_id=$post_id' style='float:right;'><button class='btn btn-info'>Comment</button></a><br>
				</div>
				<div class='col-sm-3'>
				</div>
			</div><br><br>
			";
		}
	}

	// Divides how the posts will be posted in the pages and link to the pages  
	include("pagination_home.php");
}




// Add a functionality for the view button in the profile page 
function single_post(){

	if(isset($_GET['post_id'])){
		
		// globalize the connection variable
		global $con;

		// get the post id from the website 
		$get_id = $_GET['post_id'];

		// from that post id access the database to get post id, user id, content of the post, image, and the post date 
		$get_posts = "SELECT * from posts where post_id='$get_id'";
		$run_posts = mysqli_query($con, $get_posts);
		$row_posts = mysqli_fetch_array($run_posts);

		$post_id = $row_posts['post_id'];
		$user_id = $row_posts['user_id'];
		$content = $row_posts['post_content'];
		$upload_image = $row_posts['upload_image'];
		$post_date = $row_posts['post_date'];

		// from the user id, access the databas to get the user's name and the image they posted
		$user = "SELECT * from users where user_id='$user_id' AND posts='yes'";
		$run_user = mysqli_query($con, $user);
		$row_user = mysqli_fetch_array($run_user);

		$user_name = $row_user['user_name'];
		$first_name = $row_user['f_name'];
		$last_name = $row_user['l_name'];
		$user_image = $row_user['user_image'];

		// get the email of the user that is logged in 
		$user_com = $_SESSION['user_email'];

		// from that email access the database and get the user's id and name 
		$get_com = "SELECT * from users where user_email='$user_com'";
		$run_com = mysqli_query($con, $get_com);
		$row_com = mysqli_fetch_array($run_com);

		$user_com_id = $row_com['user_id'];
		$user_com_name = $row_com['user_name'];


		// get the post's id from the website 
		if(isset($_GET['post_id'])){
			$post_id = $_GET['post_id'];
		}

		// using that post id get the post id from the users table 
		$get_posts = "SELECT post_id from users where post_id='$post_id'";
		$run_user = mysqli_query($con, $get_posts);

		// get the post id from the URL
		$post_id = $_GET['post_id'];


		$post = $_GET['post_id'];

		// search the posts table were the post id is te same as the one we found 
		$get_user = "SELECT * from posts where post_id='$post'";
		$run_user = mysqli_query($con, $get_user);
		$row = mysqli_fetch_array($run_user);

		$p_id = $row['post_id'];


		// if the ID of the post that we are showing is not equal to the post ID of what the user clicked 
		if($p_id != $post_id){

			echo"<script>alert('Security Breach !!!')</script>";
			echo"<script>window.open('home.php','_self')</script>";

		}else{

			// if the post contains only an image with no description 
			if($content=="No" && strlen($upload_image) >= 1){
				echo"
				<div class='row'>
					<div class='col-sm-3'>
					</div>
					<div id='posts' class='col-sm-6'>
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
					</div>
					<div class='col-sm-3'>
					</div>
				</div><br><br>
				";
			}

			// if the post contains both an image and a description 
			else if(strlen($content) >= 1 && strlen($upload_image) >= 1){
				echo"
				<div class='row'>
					<div class='col-sm-3'>
					</div>
					<div id='posts' class='col-sm-6'>
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
					</div>
					<div class='col-sm-3'>
					</div>
				</div><br><br>
				";
			}

			// if the post contains only text 
			else{
				echo"
				<div class='row'>
					<div class='col-sm-3'>
					</div>
					<div id='posts' class='col-sm-6'>
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
					</div>
					<div class='col-sm-3'>
					</div>
				</div><br><br>
				";
			}

			// allows the user to add a comment to the post 
			include("comments.php");


			// creating a text area for the user to be able to leave a comment 
			echo"
				<div class='row'>
					<div class='col-sm-6 col-md-offset-3'>
						<div class='panel panel-info'>
							<div class='panel-body'>
								<form action='' method='post' class='form-inline'>
									<textarea placeholder='Write your comment here ...' class='pb-cmnt-textarea' name='comment'></textarea>
									<button class='btn btn-info pull-right' name='reply'>Comment</button>
								</form>
							</div>
						</div>
					</div>
				</div>
			";

			//if the comment button is ciicked
			if(isset($_POST['reply'])){
				$comment = htmlentities($_POST['comment']);
			
				// if the user did not write anything in the comment 
				if($comment == ""){
					echo"<script>alert('Enter a comment !!!')</script>";
					echo"<script>windw.open('single.php?post_id=$post_id','_self')</script>";
				}else{ // if the user entered a comment, then post the comment 

					// insert the comment to the database ( in the table called comment)
					$insert = "INSERT into comments (post_id,user_id,comment,comment_author,date) values('$post_id','$user_id','$comment','$user_com_name',NOW())";


					$run = mysqli_query($con, $insert);
					echo"<script>alert('Comment is added')</script>";
					echo"<script>window.open('single.php?post_id=$post_id','_self')</script>";

				}
			}

		}


	}

}



//function for displaying user posts
function user_posts(){

	// globalize the connection variable
	global $con;

	// get the user id from the URL 
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

	// using that id access the posts table and get all the posts 
	$get_posts = "SELECT * from posts where user_id='$u_id' ORDER by 1 DESC LIMIT $start_from, $per_page";
	$run_posts = mysqli_query($con,$get_posts);


	while($row_posts=mysqli_fetch_array($run_posts)){

		$post_id = $row_posts['post_id'];
		$user_id = $row_posts['user_id'];
		$content = $row_posts['post_content'];
		$upload_image = $row_posts['upload_image'];
		$post_date = $row_posts['post_date'];

		// access the database and get the user information from the users table
		$user = "SELECT * from users where user_id='$user_id' AND posts='yes'";

		$run_user = mysqli_query($con,$user);
		$row_user=mysqli_fetch_array($run_user);

		$user_name = $row_user['user_name'];
		$first_name = $row_user['f_name'];
		$last_name = $row_user['l_name'];
		$user_image = $row_user['user_image'];


		//get the user's id from the URL
		if(isset($_GET['u_id'])){
			$u_id = $_GET['u_id'];
		}


		$get_posts = "SELECT user_email from users where user_id='$u_id'";
		$run_user = mysqli_query($con,$get_posts);
		$row=mysqli_fetch_array($run_user);

		// get the user's email from the id we obtained fro mthe url 
		$user_email = $row['user_email'];

		// get the email of the user that is currently logged in 
		$user = $_SESSION['user_email'];

		//access the database and get the currently logged in user's id and email 
		$get_user = "SELECT * from users where user_email='$user'";
		$run_user = mysqli_query($con,$get_user);
		$row=mysqli_fetch_array($run_user);

		$user_id = $row['user_id'];
		$u_email = $row['user_email'];

		// if the currently logged in user email and the email we got from the id of the url do not match, refresh the page 
		if($u_email != $user_email){
			echo"<script>alert('Security Breach !!!')</script>";
			echo"<script>window.open('my_post.php?u_id=$user_id','_self')</script>";
		}else{

			// if the post contains only an image with no description 
			if($content=="No" && strlen($upload_image) >= 1){

			echo "
				<div class='row'>
					<div class='col-sm-3'>
					</div>
					<div id='posts' class='col-sm-6'>
						<div class='row'>
							<div class='col-sm-2'>
								<p><img src='users/$user_image' class='img-circle' width='100px' height='100px'></p>
							</div>
							<div class='col-sm-6'>
								<h3><a style='text-decoration: none;cursor: pointer;color: #3897f0;' href='user_profile.php?u_id=$user_id'>$first_name $last_name <h6>( $user_name )</a></h3>
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
						<a href='single.php?post_id=$post_id' style='float:right;'><button class='btn btn-info'>Comment</button></a><br>
					</div>
					<div class='col-sm-3'>
					</div>
				</div><br><br>
			";

			}
			// if the post contains both an image and a description 
			else if(strlen($content) >= 1 && strlen($upload_image) >= 1){

				echo "
					<div class='row'>
						<div class='col-sm-3'>
						</div>
						<div id='posts' class='col-sm-6'>
							<div class='row'>
								<div class='col-sm-2'>
									<p><img src='users/$user_image' class='img-circle' width='100px' height='100px'></p>
								</div>
								<div class='col-sm-6'>
									<h3><a style='text-decoration: none;cursor: pointer;color: #3897f0;' href='user_profile.php?u_id=$user_id'>$first_name $last_name <h6>( $user_name )</a></h3>
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
							<a href='single.php?post_id=$post_id' style='float:right;'><button class='btn btn-info'>Comment</button></a><br>
						</div>
						<div class='col-sm-3'>
						</div>
					</div><br><br>
				";

			}else{

			// if the post contains only text 
			echo "
				<div class='row'>
					<div class='col-sm-3'>
					</div>
					<div id='posts' class='col-sm-6'>
						<div class='row'>
							<div class='col-sm-2'>
								<p><img src='users/$user_image' class='img-circle' width='100px' height='100px'></p>
							</div>
							<div class='col-sm-6'>
								<h3><a style='text-decoration: none;cursor: pointer;color: #3897f0;' href='user_profile.php?u_id=$user_id'>$first_name $last_name <h6>( $user_name )</a></h3>
								<h4><small style='color:black;'>Updated a post on <strong>$post_date</strong></small></h4>
							</div>
							<div class='col-sm-4'>
							</div>
						</div>
						<div class='row'>
							<div class='col-sm-12'>
								<h4><p>$content</p></h4>
							</div>
						</div>
						<a href='single.php?post_id=$post_id' style='float:right;'><button class='btn btn-info'>Comment</button></a><br>
					</div>
					<div class='col-sm-3'>
					</div>
				</div><br><br>
			";

			}
			// adds the functionality for the delete button 
			include("functions/delete_post.php");
		}
	}

	// Divides how the posts will be posted in the pages and link to the pages  
	include("pagination_mypost.php");
}





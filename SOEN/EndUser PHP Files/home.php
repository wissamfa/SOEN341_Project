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
			$get_user = "select * from users where user_email='$user'";
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


	<body>

		<div class="row">
			<div id="insert_post" class="col-sm-12">
				<center>
					<!-- This form represent everything we want to post in the home page => pictures or just text-->    
					<form action="home.php?id=<?php echo $user_id; ?>" method="post" id="f" enctype="multipart/form-data">
						<!-- Allow the user to enter a text => purely working as a description for the image they chose or just a text for their post-->
						<textarea class="form-control" id="content" rows="4" name="content" placeholder="What's in your mind?"></textarea><br>
						<!-- Allow the user to select a picture to post--> 
						<label class="btn btn-warning" id="upload_image_button">Select Image
							<input type="file" name="upload_image" size="30">
						</label>
						<!-- Create a button to allow the user to post the picture they selected --> 
						<button id="btn-post" class="btn btn-success" name="sub">Post</button>
					</form>

					<!-- Add the post the user posted in the database-->
					<?php insertPost(); ?>
				</center>
			</div>
		</div>

		<!-- Create a part where the posts will be displayed-->
		<div class="row">
			<div class="col-sm-12">
				<center><h2><strong>News Feed</strong></h2><br></center>
				<!-- Retreive the post the user posted in the database-->
				<?php echo get_posts(); ?>
			</div>
		</div>
	</body>
</html>
<?php


include("includes/connection.php");

	// add the user information to the database when the register button is clicked
	if(isset($_POST['sign_up'])){

		// creating variables and assigning each to the respective information 
		$first_name = htmlentities(mysqli_real_escape_string($con,$_POST['first_name']));
		$last_name = htmlentities(mysqli_real_escape_string($con,$_POST['last_name']));
		$pass = htmlentities(mysqli_real_escape_string($con,$_POST['u_pass']));
		$email = htmlentities(mysqli_real_escape_string($con,$_POST['u_email']));
		$country = htmlentities(mysqli_real_escape_string($con,$_POST['u_country']));
		$gender = htmlentities(mysqli_real_escape_string($con,$_POST['u_gender']));
		$birthday = htmlentities(mysqli_real_escape_string($con,$_POST['u_birthday']));
		$status = "verified";
		$posts = "no";


		 // this is used to generate a random number to be joined with the user's username => so it becomes unique
		$newgid = sprintf('%05d', rand(0, 999999));
		
		// creating a variable that stores the unique username
		$username = strtolower($first_name . "_" . $last_name . "_" . $newgid);

		// check if the username exists in the database already or not
		$check_username_query = "SELECT user_name from users where user_email='$email'";
		$run_username = mysqli_query($con,$check_username_query);

		// this checks all the usernames in the database one by one 
		$check_username = mysqli_num_rows($run_username);

		// if the username is found in the database, ask to use another username and take them to the signup page
		if($check_username == 1){
			echo "<script>alert('Username already exist, Please try using another username')</script>";
			echo "<script>window.open('signup.php', '_self')</script>";
			exit();
		}


		// check the length of the password ( it should be length 9 or more)
		if(strlen($pass) < 8 ){
			echo"<script>alert('Password should be minimum 8 characters!')</script>";
			exit();
		}


		$check_email = "SELECT * from users where user_email='$email'";
		$run_email = mysqli_query($con,$check_email);

		// this checks all the emails in the database one by one 
		$check = mysqli_num_rows($run_email);

		// if the email is found in the database, ask to use another email and take them to the signup page
		if($check == 1){
			echo "<script>alert('Email already exist, Please try using another email')</script>";
			echo "<script>window.open('signup.php', '_self')</script>";
			exit();
		}

		// Generate a random number between 1 and 3
		$rand = rand(1, 3); 

			// Give a user a random profile picture from the following 3 choices 
			if($rand == 1)
				$profile_pic = "pic1.png";
			else if($rand == 2)
				$profile_pic = "pic2.png";
			else if($rand == 3)
				$profile_pic = "pic3.png";


		// insert the data into the database 		
		$insert = "INSERT into users (f_name,l_name,user_name,describe_user,Relationship,user_pass,user_email,user_country,user_gender,user_birthday,user_image,user_cover,user_reg_date,status,posts,recovery_account)
		values('$first_name','$last_name','$username','Hello TheGram. This is my default status!','...','$pass','$email','$country','$gender','$birthday','$profile_pic','default_cover.jpg',NOW(),'$status','$posts','Iwanttoputading intheuniverse.')";
																																					// NOW() : a fucntion that returns the current time ( used to represent what time the account was created)
		
		$query = mysqli_query($con, $insert);

		// if user is able to register, redirect them to the login page 
		if($query){
			echo "<script>alert('Well Done $first_name, you are good to go.')</script>";
			echo "<script>window.open('signin.php', '_self')</script>";
		}
		// if registration failed, redirect them to the registration page
		else{
			echo "<script>alert('Registration failed, please try again!')</script>";
			echo "<script>window.open('signup.php', '_self')</script>";
		}
    }
    
?>

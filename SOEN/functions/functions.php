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


<style>

/* Style for the page link in the buttom of the home page */
.pagination a{
	color: black;
	float: left;
	padding: 8px 16px;
	text-decoration: none;
	transition: background-color .3s;
}

/* make the links change when we hover the curver over it */
.pagination a:hover:not(.active){background-color: #ddd;}

</style>

<?php

	// access the database to get all the posts 
	$query = "SELECT * from posts where user_id='$u_id'";
    $result = mysqli_query($con, $query);
    
    // store all the posts in a vaiable 
	$total_posts = mysqli_num_rows($result);

    // divide the posts to 6 posts per page 
	$total_pages = ceil($total_posts / $per_page);

    // creat a link to go back to the first page of the posts 
	echo"
		<center>
		<div class='pagination'>
		<a href='my_post.php?u_id=$u_id&page=1'><<</a>
	";

    // create a link to different pages ( add numbers between the first and the last page ) 
	for ($i=1; $i <= $total_pages ; $i++) { 
		echo"<a href='my_post.php?u_id=$u_id&page=$i'>$i</a>";
	}

    // create a link to the last page 
	echo"<a href='my_post.php?u_id=$u_id&page=$total_pages'>>></a></div>";
?>
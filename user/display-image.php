<?php
	include ('connection.php');
	$id = $_GET['imgId'];
	$queryImage = mysqli_query($conn, "SELECT * from food WHERE food_id=$id");
	while($result = mysqli_fetch_assoc($queryImage)){
		header('Content-Type: image/jpeg');
		echo $result['food_img'];	
	}
?>
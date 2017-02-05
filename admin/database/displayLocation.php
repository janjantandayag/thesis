<?php
	include ('connection.php');
	$id = $_GET['locationId'];
	$queryImage = mysqli_query($conn, "SELECT * from location WHERE location_id=$id");
	while($result = mysqli_fetch_assoc($queryImage)){
		header('Content-Type: image/jpeg');
		echo $result['location_img'];	
	}
?>
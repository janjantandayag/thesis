<?php
	include ('connection.php');
	$id = $_GET['id'];
	$name = strtolower(mysqli_real_escape_string($conn, $_GET['name']));
	$address = strtolower(mysqli_real_escape_string($conn, $_GET['address']));
	$lat = strtolower(mysqli_real_escape_string($conn, $_GET['lat']));
	$lang = strtolower(mysqli_real_escape_string($_GET['lang']));
	$deleteEmotion = mysqli_query($conn, "UPDATE location SET location_name= '$name',address='$address',lat='$lat',lang='$lang' WHERE location_id=$id");
?>
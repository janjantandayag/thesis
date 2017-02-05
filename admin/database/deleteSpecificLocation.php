<?php
	include ('connection.php');
	$id = $_GET['id'];
	$deleteFood = mysqli_query($conn, "DELETE FROM location WHERE location_id=$id");
	$deleteFoodAttribute = mysqli_query($conn, "DELETE FROM food_location WHERE location_id=$id");
?>
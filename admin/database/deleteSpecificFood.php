<?php
	include ('connection.php');
	$id = $_GET['id'];
	$deleteFood = mysqli_query($conn, "DELETE FROM food WHERE food_id=$id");
	$deleteFoodAttribute = mysqli_query($conn, "DELETE FROM attribute_food WHERE food_id=$id");
	$deleteFoodAttribute = mysqli_query($conn, "DELETE FROM food_location WHERE food_id=$id");
?>
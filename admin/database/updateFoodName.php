<?php
	include ('connection.php');
	$id = $_GET['id'];
	$name = strtolower($_GET['name']);
	$updateFoodName = mysqli_query($conn, "UPDATE food SET food_name= '$name' WHERE food_id=$id");
?>
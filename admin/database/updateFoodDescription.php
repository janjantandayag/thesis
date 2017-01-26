<?php
	include ('connection.php');
	$id = $_GET['id'];
	$description = strtolower($_GET['description']);
	$updateFoodDescription = mysqli_query($conn, "UPDATE food SET food_description= '$description' WHERE food_id=$id");
?>
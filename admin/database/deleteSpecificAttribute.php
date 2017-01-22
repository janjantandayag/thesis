<?php
	include ('connection.php');
	$id = $_GET['id'];
	$deleteAttribute = mysqli_query($conn, "DELETE FROM attribute WHERE attribute_id=$id");
	$deleteEmotionAttribute = mysqli_query($conn, "DELETE FROM attribute_emotion WHERE attribute_id=$id");
	$deleteAttributeFood = mysqli_query($conn, "DELETE FROM attribute_food WHERE attribute_id=$id");
?>
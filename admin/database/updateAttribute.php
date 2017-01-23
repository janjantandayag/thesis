<?php
	include ('connection.php');
	$id = $_GET['id'];
	$name = strtolower($_GET['name']);
	$deleteEmotion = mysqli_query($conn, "UPDATE attribute SET attribute_name= '$name' WHERE attribute_id=$id");
?>
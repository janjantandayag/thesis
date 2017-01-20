<?php
	include ('connection.php');
	$id = $_GET['id'];
	$name = strtolower($_GET['name']);
	$deleteEmotion = mysqli_query($conn, "UPDATE emotion SET emotion_name= '$name' WHERE emotion_id=$id");
?>
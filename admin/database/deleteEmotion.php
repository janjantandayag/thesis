<?php
	include ('connection.php');
	$id = $_GET['id'];
	$deleteEmotion = mysqli_query($conn, "DELETE FROM emotion WHERE emotion_id=$id");
	$deleteEmotionAttribute = mysqli_query($conn, "DELETE FROM attribute_emotion WHERE emotion_id=$id");
?>
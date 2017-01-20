<?php
	include ('connection.php');
	$id = $_GET['id'];
	$emotionId = $_GET['emotionId'];
	$deleteAttribute = mysqli_query($conn, "DELETE FROM attribute_emotion WHERE emotion_id=$emotionId AND attribute_id = $id");
?>
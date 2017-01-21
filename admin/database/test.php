<?php
	include ('connection.php');
	$emotionId = 52;

	$selectAttribute = mysqli_query($conn, "SELECT * FROM attribute,emotion,attribute_emotion WHERE emotion.emotion_id = $emotionId AND attribute_emotion.emotion_id = attribute_emotion.emotion_id AND attribute_emotion.attribute_id = attribute.attribute_id");
	return $selectAttribute;
?>
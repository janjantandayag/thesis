<?php
include ('connection.php');
if($_POST){

	$attributes = $_POST['newAddSelect'];
	$emotionId = $_POST['emotionId'];
	$emotionName = $_POST['emotionName'];
	foreach ($attributes as $attribute) {
		$query = mysqli_query($conn, "INSERT INTO attribute_emotion(emotion_id,attribute_id) VALUE($emotionId, $attribute)");
	}
	echo "<script>
			alert('Successfully added!');
		  </script>";
	header("location: ../emotion-update.php?emotionId=$emotionId&emotionName=$emotionName");

}
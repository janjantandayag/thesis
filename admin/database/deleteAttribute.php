<?php
	include ('connection.php');
	$id = $_GET['id'];
	$emotionId = $_GET['emotionId'];
	$deleteAttribute = mysqli_query($conn, "DELETE FROM attribute_emotion WHERE emotion_id=$emotionId AND attribute_id = $id");

	$selectNot = mysqli_query($conn, "SELECT * FROM attribute WHERE attribute.attribute_id NOT IN (SELECT attribute.attribute_id FROM attribute, attribute_emotion WHERE attribute_emotion.emotion_id = $emotionId AND attribute_emotion.attribute_id = attribute.attribute_id)");

	while($allResult = mysqli_fetch_assoc($selectNot)){
		$var1 = "<option value='";
		$attributeName = $allResult['attribute_id'];
		$var2 = "'>".$allResult['attribute_name'].'</option>';
		$option = $var1.$attributeName.$var2;
		echo $option;
	}

?>
<?php
include ('connection.php');
if($_POST){

	$foods = $_POST['newAddSelect'];
	$attributeId = $_POST['attributeId'];
	$attributeName = $_POST['attributeName'];
	foreach ($foods as $foodId) {
		$query = mysqli_query($conn, "INSERT INTO attribute_food(food_id,attribute_id) VALUE($foodId, $attributeId)");
	}	
	echo "<script>
			alert('Successfully added!');
			window.location = '../attribute-update.php?attributeId=$attributeId&attributeName=$attributeName';
		  </script>";

}
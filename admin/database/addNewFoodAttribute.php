<?php
include ('connection.php');
if($_POST){

	$attributes = $_POST['newAddSelect'];
	$foodId = $_POST['foodId'];
	$foodName = $_POST['foodName'];
	foreach ($attributes as $attribute) {
		$query = mysqli_query($conn, "INSERT INTO attribute_food(food_id,attribute_id) VALUE($foodId, $attribute)");
	}
	echo "<script>
			alert('Successfully added!');
			window.location = '../food-update.php?foodId=$foodId&foodName=$foodName';
		  </script>";

}
<?php
	include ('connection.php');
	$attributeId = $_GET['attributeId'];
	$foodId = $_GET['foodId'];
	$deleteAttributeFood = mysqli_query($conn, "DELETE FROM attribute_food WHERE food_id=$foodId AND attribute_id = $attributeId");

	$selectNot = mysqli_query($conn, "SELECT * FROM food WHERE food.food_id NOT IN (SELECT food.food_id FROM food, attribute_food WHERE attribute_food.attribute_id = $attributeId AND attribute_food.food_id = food.food_id)");

	while($allResult = mysqli_fetch_assoc($selectNot)){
		$var1 = "<option value='";
		$foodId = $allResult['food_id'];
		$foodName = "'>".$allResult['food_name'].'</option>';
		$option = $var1.$foodId.$foodName;
		echo $option;
	}

?>
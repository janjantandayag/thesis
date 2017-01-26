<?php
	include ('connection.php');
	$attributeId = $_GET['attributeId'];
	$foodId = $_GET['foodId'];
	$deleteAttributeFood = mysqli_query($conn, "DELETE FROM attribute_food WHERE food_id=$foodId AND attribute_id = $attributeId");

	$selectNot = mysqli_query($conn, "SELECT * FROM attribute WHERE attribute.attribute_id NOT IN (SELECT attribute.attribute_id FROM food, attribute_food WHERE attribute_food.food_id = $foodId AND attribute_food.attribute_id = attribute.attribute_id)");

	while($allResult = mysqli_fetch_assoc($selectNot)){
		$var1 = "<option value='";
		$foodId = $allResult['attribute_id'];
		$foodName = "'>".$allResult['attribute_name'].'</option>';
		$option = $var1.$foodId.$foodName;
		echo $option;
	}

?>
<?php
	include ('connection.php');
	$locationId = $_GET['locationId'];
	$foodId = $_GET['foodId'];
	$deleteFoodLocation = mysqli_query($conn, "DELETE FROM food_location WHERE food_id=$foodId AND location_id = $locationId");

	$selectNot = mysqli_query($conn, "SELECT * FROM location WHERE location.location_id NOT IN (SELECT location.location_id FROM food, food_location WHERE food_location.food_id = $foodId AND food_location.location_id = location.location_id)");

	while($allResult = mysqli_fetch_assoc($selectNot)){
		$var1 = "<option value='";
		$locationId = $allResult['location_id'];
		$locationName = "'>".$allResult['location_name'].'</option>';
		$option = $var1.$locationId.$locationName;
		echo $option;
	}

?>
<?php
include ('connection.php');
if($_POST){
	$locations = $_POST['newAddSelect'];
	$foodId = $_POST['foodId'];
	$foodName = $_POST['foodName'];
	foreach ($locations as $location) {
		$query = mysqli_query($conn, "INSERT INTO food_location(food_id,location_id) VALUE($foodId, $location)");
	}
	echo "<script>
			alert('Successfully added!');
			window.location = '../food-update.php?foodId=$foodId&foodName=$foodName';
		  </script>";

}
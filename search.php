<?php
	include('connection.php');
	$emotionQuery = $_GET['emotion'];
	$array = array();
	$query = mysqli_query($conn, "SELECT * FROM emotion WHERE emotion_name LIKE '%$emotionQuery%'");
	if(mysqli_num_rows($query) != 0) {
		while ($row = mysqli_fetch_assoc($query)) {
	  		$array[] = $row['emotion_name'];
		}
		echo json_encode($array);
	}
	else{
		$array[] = "<i onclick='return false;' style='font-size:80%'> Sorry! emotion not found </i>";
		echo json_encode($array);
	}
?>
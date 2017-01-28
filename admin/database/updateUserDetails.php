<?php 
	session_start();
	include('connection.php');
	$first_name = $_GET['firstName'];
	$middle_name  = $_GET['middleName'];
	$last_name = $_GET['lastName'];
	$id = $_SESSION['userId'];
	$_SESSION['firstName'] = $first_name;
	$_SESSION['middleName'] = $middle_name;
	$_SESSION['lastName'] = $last_name;
	$query = mysqli_query($conn, "UPDATE users SET first_name = '$first_name', last_name = '$last_name' , middle_name='$middle_name' WHERE users.user_id = $id ");
?>
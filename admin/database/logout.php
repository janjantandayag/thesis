<?php
	session_start();
	session_unset($_SESSION['userId'], $_SESSION['firstName'], $_SESSION['lastName']); 
	session_destroy(); 
	echo "<script>
		alert('Logged out successfully!');
		window.location = '../index.php';
	  </script>";
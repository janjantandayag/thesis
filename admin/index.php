<?php
	include('database/Function.php');
	if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true ){
		// $currentPage = substr(strtok($_SERVER['REQUEST_URI'],'?'), 14);
		// header("location:'.$currentPage."'"");
		echo "<script>
			alert('You are currently logged in! Please logged to used another account');
			window.location = 'dashboard.php';
		</script>";
	}
	else{
	$db = new DatabaseFunction;
?>


<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="css/login-style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
</head>
<body>
	<div class="wrapper">
		<form method="POST" action="index.php">
			<input type="text" name="username" placeholder="username" required>
			<input type="password" name="password" placeholder="password" required />
			<input type="submit" name='submit' value="Login" />
		</form>
		<?php 
			if(isset($_POST['submit'])){
				if($db->isExist($_POST['username'], $_POST['password'])){
					$db->login($_POST['username'], $_POST['password']);
				}
				else{
					?>					
		<div class="messages">
			<p>Incorrect username or password! Please try again</p>
		</div>
		<?php } }
		?>
	</div>
<script>
	$('.messages').fadeOut(3000);	
</script>
</body>
</html>
<?php } ?>
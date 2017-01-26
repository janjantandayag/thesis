<!DOCTYPE html>
<html>
<head>
	<?php include('section--links.php'); ?>
    <script src="js/typeahead.min.js"></script>
	<script src="js/live-search.js"></script>
	<title>Home</title>
</head>
<body>
	<section id="banner">
		<div class="container">
			<div class="row">
				<h1>Hi, how are you today?</h1>
				<p>Enter what you feel and we will help you what food to eat.</p>
			</div>
			<form action="result.php" method="GET">
				<div class="row">
					<div class="col-md-3 col-md-offset-3">
				  		<div class="form-group">
			    			<input type="text" required name="emotion" class="form-control typeahead tt-query" autocomplete="off" spellcheck="false" placeholder="I feel...">
				  		</div>
				  	</div>
				  	<div class="col-md-2">
				  		<div class="form-group">
					  		<input type="submit" value="search" class="form-control" />
				  		</div>
				  	</div>
				</div>
			</form>
		</div>
	</section>

	<script>

	</script>
</body>
</html>
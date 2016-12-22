<?php
	include('connection.php');

	$emotionName = $_GET['emotion'];
?>
<!DOCTYPE html>
<html>
<head>
	<?php include('section--links.php'); ?>
    <script src="js/typeahead.min.js"></script>
	<script src="js/live-search.js"></script>
	<title>Results</title>
</head>
<body>
	<?php include ('page-header.php') ?>
	<section id="result-content">
		<div class="container">
			<div class="search-label">
				<div class="row">
					<div class="col-md-12">
						<p>Showing result for: <span><?= $emotionName ?></span></p>
					</div>
				</div>
			</div>
			<div class="search-content">
				<div class="row">
					<div class="col-md-6">
						<div class="row">
							<div class="col-md-6">
								<img src="img/result-1.jpg" class="img-responsive"/>
							</div>
							<div class="col-md-6">
								<h2 class="food-header">Hamburger</h2>
								<p class="food-description">A Hamburger (or cheeseburger when 
								served with a slice of cheese) is a 
								sandwich consisting of one or more 
								cooked patties of ground meat, usually 
								beef, placed inside a sliced bread roll</p>
								<a href="#" class="food-button">Show more details</a>
							</div>
						</div>
					</div>
                    <div class="col-md-6">
						<div class="row">
							<div class="col-md-6">
								<img src="img/result-2.jpg" class="img-responsive"/>
							</div>
							<div class="col-md-6">
								<h2 class="food-header">French Fries</h2>
								<p class="food-description">A French fries (American English), chips (British English), fries, finger chips (Indian English), or French-fried potatoes are batonnet or allumette cut deep-fried</p>
								<a href="#" class="food-button">Show more details</a>
							</div>
						</div>
					</div>
				</div><div class="row">
					<div class="col-md-6">
						<div class="row">
							<div class="col-md-6">
								<img src="img/result-1.jpg" class="img-responsive"/>
							</div>
							<div class="col-md-6">
								<h2 class="food-header">Hamburger</h2>
								<p class="food-description">A Hamburger (or cheeseburger when 
								served with a slice of cheese) is a 
								sandwich consisting of one or more 
								cooked patties of ground meat, usually 
								beef, placed inside a sliced bread roll</p>
								<a href="#" class="food-button">Show more details</a>
							</div>
						</div>
					</div>
                    <div class="col-md-6">
						<div class="row">
							<div class="col-md-6">
								<img src="img/result-2.jpg" class="img-responsive"/>
							</div>
							<div class="col-md-6">
								<h2 class="food-header">French Fries</h2>
								<p class="food-description">A French fries (American English), chips (British English), fries, finger chips (Indian English), or French-fried potatoes are batonnet or allumette cut deep-fried</p>
								<a href="#" class="food-button">Show more details</a>
							</div>
						</div>
					</div>
				</div><div class="row">
					<div class="col-md-6">
						<div class="row">
							<div class="col-md-6">
								<img src="img/result-1.jpg" class="img-responsive"/>
							</div>
							<div class="col-md-6">
								<h2 class="food-header">Hamburger</h2>
								<p class="food-description">A Hamburger (or cheeseburger when 
								served with a slice of cheese) is a 
								sandwich consisting of one or more 
								cooked patties of ground meat, usually 
								beef, placed inside a sliced bread roll</p>
								<a href="#" class="food-button">Show more details</a>
							</div>
						</div>
					</div>
                    <div class="col-md-6">
						<div class="row">
							<div class="col-md-6">
								<img src="img/result-2.jpg" class="img-responsive"/>
							</div>
							<div class="col-md-6">
								<h2 class="food-header">French Fries</h2>
								<p class="food-description">A French fries (American English), chips (British English), fries, finger chips (Indian English), or French-fried potatoes are batonnet or allumette cut deep-fried</p>
								<a href="#" class="food-button">Show more details</a>
							</div>
						</div>
					</div>
				</div><div class="row">
					<div class="col-md-6">
						<div class="row">
							<div class="col-md-6">
								<img src="img/result-1.jpg" class="img-responsive"/>
							</div>
							<div class="col-md-6">
								<h2 class="food-header">Hamburger</h2>
								<p class="food-description">A Hamburger (or cheeseburger when 
								served with a slice of cheese) is a 
								sandwich consisting of one or more 
								cooked patties of ground meat, usually 
								beef, placed inside a sliced bread roll</p>
								<a href="#" class="food-button">Show more details</a>
							</div>
						</div>
					</div>
                    <div class="col-md-6">
						<div class="row">
							<div class="col-md-6">
								<img src="img/result-2.jpg" class="img-responsive"/>
							</div>
							<div class="col-md-6">
								<h2 class="food-header">French Fries</h2>
								<p class="food-description">A French fries (American English), chips (British English), fries, finger chips (Indian English), or French-fried potatoes are batonnet or allumette cut deep-fried</p>
								<a href="#" class="food-button">Show more details</a>
							</div>
						</div>
					</div>
				</div><div class="row">
					<div class="col-md-6">
						<div class="row">
							<div class="col-md-6">
								<img src="img/result-1.jpg" class="img-responsive"/>
							</div>
							<div class="col-md-6">
								<h2 class="food-header">Hamburger</h2>
								<p class="food-description">A Hamburger (or cheeseburger when 
								served with a slice of cheese) is a 
								sandwich consisting of one or more 
								cooked patties of ground meat, usually 
								beef, placed inside a sliced bread roll</p>
								<a href="#" class="food-button">Show more details</a>
							</div>
						</div>
					</div>
                    <div class="col-md-6">
						<div class="row">
							<div class="col-md-6">
								<img src="img/result-2.jpg" class="img-responsive"/>
							</div>
							<div class="col-md-6">
								<h2 class="food-header">French Fries</h2>
								<p class="food-description">A French fries (American English), chips (British English), fries, finger chips (Indian English), or French-fried potatoes are batonnet or allumette cut deep-fried</p>
								<a href="#" class="food-button">Show more details</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		    <div class="pagination">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <a href="#" class="previous"><span class="fa fa-arrow-left"></span></a>
                            <a href="#" class="active-page">1</a>
                            <a href="#">2</a>
                            <a href="#">3</a>
                            <a href="#">4</a>
                            <a href="#">5</a>
                            <a href="#" class="next"><span class="fa fa-arrow-right"></span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
	</section>
</body>
</html>
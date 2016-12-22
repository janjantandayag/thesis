<!DOCTYPE html>
<html>
<head>
	<?php include('section--links.php'); ?>
    <script src="js/typeahead.min.js"></script>
	<script src="js/live-search.js"></script>
	<title>Home</title>
</head>
<body>
	<?php include ('page-header.php') ?>
	<section id="food-detail">
		<div class="container">
			<div class="row">
				<div class="col-md-4">
					<img src="img/result-1.jpg" width="100%" >
				</div>
				<div class="col-md-8">
					<h1 class="detail--foodname">Hamburger</h1>
					<p class="detail--fooddesc">A Hamburger (or cheeseburger when served with a slice of cheese) is a sandwich consisting of one or
						more cooked patties of ground meat, usually beef, placed inside a sliced bread roll.
					</p>
				</div>
			</div>
		</div>
	</section>
	<section id="locations">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h2 class="locations--header">Location Available</h2>
				</div>
			</div>
		</div>
		<div id="map-container">
			<div class="container-fluid">
				<div id="map"></div>
			</div>
		</div>
		<div class="location-available">
			<div class="container">
				<div class="row">
					<div class="col-md-6 location-border">
						<div class="col-md-6">
							<img src="img/mall-1.jpg" width="100%"/>
						</div>
						<div class="col-md-6 col-sm-6">
                            <div class="row">
                                <div class="col-md-12 no-padding">
                                    <h2 class="location--name">Robinson's Place</h2>
                                </div>
                            </div>
							<div class="row location-desc-container">
								<div class="col-sm-2 no-padding">
									<span class="fa fa-map-marker"></span>
								</div>
								<div class="col-sm-10">
									<p class="location-desc">J.C Aquino Avenue, Butuan City</p>
								</div>
							</div>
							<div class="row location-desc-container">
								<div class="col-sm-2 no-padding">
									<span class="fa fa-mobile"></span>
								</div>
								<div class="col-sm-10">			<p class="location-desc" >09123412341</p>
								</div>
							</div>
							<div class="row location-desc-container">
								<div class="col-sm-2 no-padding">
									<span class="fa fa-phone"></span>
								</div>
								<div class="col-sm-10">
									<p class="location-desc">224-8193</p>
								</div>
							</div>
							<div class="row">
								<a href="#" class="button--showmap">Show Map</a>
							</div>
						</div>	
					</div>					
                    <div class="col-md-6 location-border">
						<div class="col-md-6">
							<img src="img/mall-2.jpg" width="100%"/>
						</div>
						<div class="col-md-6 col-sm-6">
                            <div class="row">
                                <div class="col-md-12 no-padding">
                                    <h2 class="location--name">Gaisano Mall</h2>
                                </div>
                            </div>
							<div class="row location-desc-container">
								<div class="col-sm-2 no-padding">
									<span class="fa fa-map-marker"></span>
								</div>
								<div class="col-sm-10">
									<p class="location-desc">J.C Aquino Avenue, Butuan City</p>
								</div>
							</div>
							<div class="row location-desc-container ">
								<div class="col-sm-2 no-padding">
									<span class="fa fa-mobile"></span>
								</div>
								<div class="col-sm-10">			<p class="location-desc" >09123412341</p>
								</div>
							</div>
							<div class="row location-desc-container">
								<div class="col-sm-2 no-padding">
									<span class="fa fa-phone"></span>
								</div>
								<div class="col-sm-10">
									<p class="location-desc">224-8193</p>
								</div>
							</div>
							<div class="row">
								<a href="#" class="button--showmap">Show Map</a>
							</div>
						</div>	
					</div>
                </div>
			</div>
		</div>
	</section>
</body>
</html>
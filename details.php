<?php
	include('connection.php');
	$foodId = $_GET['id'];
?>
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
			<?php
				$query = mysqli_query($conn, "SELECT * from food, food_location, location WHERE food.food_id = $foodId AND food.food_id = food_location.food_id AND food_location.location_id = location.location_id");
				$row = mysqli_fetch_assoc($query);
			?>
			<div class="row">
				<div class="col-md-4">
					<img src="display-image.php?imgId=<?= $row['food_id'] ?>" width="100%" />
				</div>
				<div class="col-md-8">
					<h1 class="detail--foodname"><?= $row['food_name']?></h1>
					<p class="detail--fooddesc"><?= $row['food_description']?>
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
				<?php
					$queryLocation = mysqli_query($conn, "SELECT * from food, food_location, location WHERE food.food_id = $foodId AND food.food_id = food_location.food_id AND food_location.location_id = location.location_id");
					$numOfLocation = mysqli_num_rows($queryLocation);
				?>
				<div class="row">
					<div class="col-md-12">
						<p class="location-num"><span class="num"><?= $numOfLocation ?></span> locations found<p>
					</div>
				</div>
				<div class="row">
				<?php 
					while($location = mysqli_fetch_assoc($queryLocation)){ ?>
                    <div class="col-md-6 location-border">
						<div class="col-md-6">
							<img src="display-location.php?imgId=<?= $location['location_id'] ?>" width="100%" />
						</div>
						<div class="col-md-6 col-sm-6">
                            <div class="row">
                                <div class="col-md-12 no-padding">
                                    <h2 class="location--name"><?= $location['location_name'] ?></h2>
                                </div>
                            </div>
							<div class="row location-desc-container">
								<div class="col-sm-2 no-padding">
									<span class="fa fa-map-marker"></span>
								</div>
								<div class="col-sm-10">
									<p class="location-desc"><?= $location['address'] ?></p>
								</div>
							</div>
							<div class="row location-desc-container ">
								<div class="col-sm-2 no-padding">
									<span class="fa fa-mobile"></span>
								</div>
								<div class="col-sm-10">			<p class="location-desc" ><?= $location['phone_number'] ?></p>
								</div>
							</div>
							<div class="row location-desc-container">
								<div class="col-sm-2 no-padding">
									<span class="fa fa-phone"></span>
								</div>
								<div class="col-sm-10">
									<p class="location-desc"><?= $location['mobile_number'] ?></p>
								</div>
							</div>
							<div class="row">
								<a href="#map" onclick="displayMap(<?= $location['lat'] ?>, <?= $location['lang'] ?> )" class="button--showmap">Show Map</a>
							</div>
						</div>	
					</div>
					<?php } ?>
                </div>
			</div>
		</div>
	</section>


<script>
	function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          center: new google.maps.LatLng(8.9475, 125.5406),
          zoom: 15
        });		
    }
    
    function displayMap(latitude, langhitude) {
        var latitude;
        var langhitude;
        var point = new google.maps.LatLng(
                  parseFloat(latitude),
                  parseFloat(langhitude)
              );   

        var map = new google.maps.Map(document.getElementById('map'), {
          center: new google.maps.LatLng(latitude, langhitude),
          zoom: 16
        });

        var marker = new google.maps.Marker({
          map: map,
          position: point,
        });
    }
</script>
<script async defer
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA9kKz7oqKE_kvxHAbuW3-32O6Uv9MHBPs&callback=initMap">
</script>
</body>
</html>
<?php
	include('database/DatabaseFunction.php');
	$db = new DatabaseFunction;
	$foodId = $_GET['id'];
	$emotionName = $_GET['emotionName'];
	$food = $db->getFoodDetails($foodId);
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
	<?php  include ('page-header.php')  ?>
	<?php if($food) : ?>
	<section id="food-detail">
		<div class="container">
			<div class="row">
				<div class="col-md-4">
					<img src="display-image.php?imgId=<?= $food['food_id'] ?>" width="100%" />
				</div>
				<div class="col-md-8">
					<h1 class="detail--foodname"><?= $food['food_name']?></h1>
					<p class="detail--fooddesc"><?= $food['food_description']?>
					</p>
				</div>
			</div>
		</div>
	</section>
	<section id="locations"><!-- Trigger the modal with a button -->
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h2 class="locations--header">Locations Available</h2>
				</div>
			</div>
		</div>
		<div class="location-available">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<p class="location-num"><span class="num"><?= $db->getNumLocation($foodId); ?></span> locations found<p>
					</div>
				</div>
				<div class="row">
					<?php foreach($db->getFoodLocation($foodId) as $location): ?>
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
								<div class="col-sm-10"><p class="location-desc" ><?= $location['phone_number'] ?></p>
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
								<a href="#" data-toggle="modal" data-target="#myModal" onclick="displayMap(<?= $location['lat'] ?>, <?= $location['lang'] ?> )" class="button--showmap">Show Map</a>
							</div>
						</div>	
					</div>
					<?php endforeach; ?>
                </div>
			</div>
		</div>
	</section>
	<?php else : ?>
	<div class="not-found">
    	<p>Sorry! We are still working</p>
    </div>
	<?php endif; ?>
	<!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
        <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">NAME OF RESTAURANT - PLACE</h4>
                </div>
                <div class="modal-body">
                    <div id="map-container">
                        <div id="map"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
<script>
	// function initMap(){
	//     var map = new google.maps.Map(document.getElementById('map'), {
	//       center: new google.maps.LatLng(8.9475, 125.5406),
	//       zoom: 13,
	//       styles: [
	// 		  {
	// 		    "featureType": "road.local",
	// 		    "elementType": "labels.text.fill",
	// 		    "stylers": [
	// 		      {
	// 		        "color": "#333301"
	// 		      }
	// 		    ]
	// 		  }
	// 		]
	//     });

	//     var infoWindow = new google.maps.InfoWindow;
	//       downloadUrl('xml.php?food_id='+<?= $foodId ?>, function(data) {
	//         var xml = data.responseXML;
	//         var markers = xml.documentElement.getElementsByTagName('marker');
	//         Array.prototype.forEach.call(markers, function(markerElem) {
	//           var name = markerElem.getAttribute('name');
	//           var point = new google.maps.LatLng(
	//               parseFloat(markerElem.getAttribute('lat')),
	//               parseFloat(markerElem.getAttribute('lng'))
	//           );

	//           var infowincontent = document.createElement('div');
	//           var strong = document.createElement('strong');
	//           strong.textContent = name;
	//           infowincontent.appendChild(strong);

	//           var marker = new google.maps.Marker({
	//             map: map,
	//             position: point,
	//           });

	//           marker.addListener('click', function() {
	//             map.setZoom(20);
 //                map.setCenter(marker.getPosition());
	//           });
	//         });
	//       });
	//     }


	// function downloadUrl(url, callback) {
	//     var request = window.ActiveXObject ?
	//         new ActiveXObject('Microsoft.XMLHTTP') :
	//         new XMLHttpRequest;

	//     request.onreadystatechange = function() {
	//       if (request.readyState == 4) {
	//         request.onreadystatechange = doNothing;
	//         callback(request, request.status);
	//       }
	//     };
	//     request.open('GET', url, true);
	//     request.send(null);
	//  }

 //  	function doNothing() {}
    
    function displayMap(latitude, langhitude) {
        var latitude;
        var langhitude;
        var point = new google.maps.LatLng(
                  parseFloat(latitude),
                  parseFloat(langhitude)
              );   

        var map = new google.maps.Map(document.getElementById('map'), {
          center: point,
          zoom: 15, 
          mapTypeControl: true,
          mapTypeControlOptions: {
            style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
            position: google.maps.ControlPosition.TOP_CENTER
          },
          zoomControl: true,
          zoomControlOptions: {
            position: google.maps.ControlPosition.LEFT_CENTER
          },
          scaleControl: true,
          streetViewControl: true,
          streetViewControlOptions: {
            position: google.maps.ControlPosition.LEFT_TOP
          },
          fullscreenControl: true
        });

        var marker = new google.maps.Marker({
          map: map,
          position: point,
          title:"The Map"
        });
        
        google.maps.event.addListenerOnce(map, 'idle', function () {
		    google.maps.event.trigger(map, 'resize');
		});
    }
</script>
<!-- <script async defer
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA9kKz7oqKE_kvxHAbuW3-32O6Uv9MHBPs&callback=initMap">
</script> -->
<script async defer
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA9kKz7oqKE_kvxHAbuW3-32O6Uv9MHBPs">
</script>

</body>
</html>
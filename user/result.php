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
					<?php
						$query = mysqli_query($conn, "SELECT DISTINCT(food.food_id),food.food_name, food.food_description from emotion, attribute_emotion,attribute, attribute_food, food WHERE emotion.emotion_name LIKE '%$emotionName%' AND emotion.emotion_id = attribute_emotion.emotion_id AND attribute_emotion.attribute_id = attribute.attribute_id AND attribute.attribute_id = attribute_food.attribute_id AND attribute_food.food_id = food.food_id");
    					
    					while($row = mysqli_fetch_assoc($query)) {
					?>
					<div class="col-md-6">
						<div class="row">
							<div class="col-md-6">
								<img src="display-image.php?imgId=<?= $row['food_id'] ?>" width="100%" />
							</div>
							<div class="col-md-6">
								<h2 class="food-header"><?= $row['food_name']; ?></h2>
								<p class="food-description">
									<?= $row['food_description'];?>
								</p>
								<a href="details.php?emotionName=<?= $emotionName ?>&id=<?=$row['food_id']?>" class="food-button">Show more details</a>
							</div>
						</div>
					</div>
					<?php } ?>
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
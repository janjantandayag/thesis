<?php
	include('database/DatabaseFunction.php');
	$db = new DatabaseFunction;
	$emotionName = $_GET['emotion'];
	if(isset($_GET['page'])){$page = $_GET['page'];}else{$page = 1;}
	$foods = $db->getFoods($page,$emotionName);
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
		<?php if($foods) { ?>
		<div class="container">
			<div class="search-label">
				<div class="row">
					<div class="col-md-12">
						<p>Showing results for: <span><?= $emotionName ?></span></p>
					</div>
				</div>
			</div>
		</div>
		<div class="search-content">
			<div class="container">
				<div class="row">
					<?php foreach($foods as $food){ ?>
					<div class="col-md-6">
						<div class="row">
							<div class="col-md-6">
								<img src="display-image.php?imgId=<?= $food['food_id'] ?>" width="100%" />
							</div>
							<div class="col-md-6">
								<h2 class="food-header"><?= $food['food_name']; ?></h2>
								<p class="food-description">
									<?php echo ucfirst($db->descriptionScreen($food['food_description'])); ?>
								</p>
								<!-- <a href="details.php?emotionName=<?= $emotionName ?>&id=<?=$row['food_id']?>" class="food-button">Show more details</a> -->
							 </div>
						</div>
					</div><?php } ?>
				</div>
			</div>
			<?php $totalPages = $db->pagination($emotionName);?>
            <div class="container">
		    	<div class="pagination">
                    <div class="row">
                        <div class="col-md-12">
                            <a href="result.php?emotion=<?= $emotionName ?>&page=<?=$page-1?>" class="previous" style="<?php if($page<=1){ echo 'pointer-events: none;cursor:default;border-color: #e0e6e0;color: #e0e6e0';}?>"><span class="fa fa-arrow-left"></span></a>
                        	<?php for($i=1;$i<=$totalPages;$i++){ ?>
                            <a href="result.php?emotion=<?= $emotionName ?>&page=<?=$i?>" class="<?php if($i==$page){echo 'active-page'; } ?>"><?=$i?></a>
                            <?php } ?>                            
                            <a href="result.php?emotion=<?= $emotionName ?>&page=<?=$page+1?>" class="next" style="<?php if($page>=$totalPages){ echo 'pointer-events: none;cursor:default;border-color: #e0e6e0;color: #e0e6e0';}?>" ><span class="fa fa-arrow-right"></span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php } else {?>
        <div class="not-found">
        	<p>Sorry! No result found for <span class="emotion-name"><?= $emotionName ?></span></p>
        </div>

        <?php } ?>
	</section>
</body>
</html>

<?php
	include('database/DatabaseFunction.php');
	$db = new DatabaseFunction;
	$emotions = $db->displayEmotions();
	$count = $db->getNumEmotion();
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
	<section id="banner">
		<div class="container">
			<div class="row">
				<h1>Hi, how are you today?</h1>
				<p>Select or search what you feel and we will help you what food to eat.</p>
			</div>
			<div class="row emotion-stats">
				<div class="col-md-5">
					<h1 class="emotion-num"><?= $count ?></h1>
					<h3 class="emotion-label">EMOTIONS</h3>
				</div>
				<div class="col-md-7 emotions">
					<?php foreach($emotions as $emotion){ ?>
					<a href="javascript:void(0)" onClick="redirectTo('<?=$emotion['emotion_name'] ?>')"class="emotion-indiv"><?= $emotion['emotion_name'] ?></a>
					<?php } ?>
				</div>
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
    // COUNTER
	$('.emotion-num').each(function () {
	    $(this).prop('Counter',0).animate({
	        Counter: $(this).text()
	    }, {
	        duration: 1500,
	        easing: 'swing',
	        step: function (now) {
	            $(this).text(Math.ceil(now));
	        }
	    });
	});

	//ONCLICK 
	function redirectTo(emotionName){
		window.location.href="result.php?emotion="+emotionName+'&page=1';
	}

</script>
</body>
</html>
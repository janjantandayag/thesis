<?php	
	session_start();
	Class DatabaseFunction{
		public $servername = 'localhost';
		public $dbname = 'thesisprototype';
		public $password = '';
		public $username = 'root';
		public $conn;

    	public function __construct(){
			try {
				    $this->conn = new PDO("mysql:host=$this->servername;dbname=$this->dbname", $this->username, $this->password);
				    // set the PDO error mode to exception
				    $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			    }
			catch(PDOException $e)
			    {
			    	echo "Connection failed: " . $e->getMessage();
			    }
		}

		public function getAllAttributes(){
			$stmt = $this->conn->prepare("SELECT * FROM attribute"); 
	 		$stmt->execute(); 
	 		$result = $stmt->fetchAll();
	 		return $result;
    	}

    	public function addNewAttribute($attrListSelected, $emotionName){
    		//CHECK IF EXISTING
			$stmt = $this->conn->prepare("SELECT * FROM emotion WHERE emotion.emotion_name LIKE '%$emotionName%'"); 
	 		$stmt->execute(); 
	 		$result = $stmt->fetchAll();
	 		//EXIST
	 		if(count($result) > 0){
	 			echo "<script>
	 				alert('already in the db');
	 			</script>";
	 		}
	 		//NOT EXIST
	 		else{
	 			//INSERT TO EMOTION
				$insertStmt = $this->conn->prepare("INSERT INTO emotion(emotion_name) VALUE('$emotionName')"); 
				$insertStmt->execute();
				//QUERY LAST ROW
				$lastRowStmt = $this->conn->prepare("SELECT emotion_id FROM emotion ORDER BY emotion_id DESC LIMIT 1");
				$lastRowStmt->execute();
				$result = $lastRowStmt->fetch();
				$lastId = $result['emotion_id'];
				//INSERT TO EMOOTION_FOODATTRIBUTE
				foreach ($attrListSelected as $attrId) {
					$insertEmoAttrStmt = $this->conn->prepare("INSERT INTO attribute_emotion(emotion_id,attribute_id) VALUE($lastId, $attrId)");
					$insertEmoAttrStmt->execute();
				}
				echo "<script>
 						alert('Successfully added!');
 						window.location = 'emotion-list.php';
 					  </script>";
	 		} 
    	}

    	public function displayEmotions(){
    		$stmt = $this->conn->prepare("SELECT DISTINCT(emotion.emotion_name), emotion.emotion_id FROM emotion, attribute_emotion, attribute WHERE emotion.emotion_id = attribute_emotion.emotion_id AND attribute_emotion.attribute_id= attribute.attribute_id"); 
	 		$stmt->execute(); 
	 		$result = $stmt->fetchAll();
	 		return $result;
    	}

    	public function getAttributes($id){
    		$stmt = $this->conn->prepare("SELECT * FROM attribute_emotion, attribute WHERE attribute_emotion.emotion_id = $id AND attribute_emotion.attribute_id= attribute.attribute_id"); 
	 		$stmt->execute(); 
	 		$result = $stmt->fetchAll();
	 		return $result;
    	}

    	public function hasComma($i,$attributes){
    		if($i == count($attributes))
    			$comma = ' ';
    		else
    			$comma = ', ';
    		return $comma;
    	}

    	public function emotionFood($id){
    		$stmt = $this->conn->prepare("SELECT * FROM emotion, attribute_emotion,attribute, attribute_food, food WHERE emotion.emotion_id = $id AND emotion.emotion_id = attribute_emotion.emotion_id AND attribute_emotion.attribute_id = attribute.attribute_id AND attribute.attribute_id = attribute_food.attribute_id AND attribute_food.food_id = food.food_id GROUP BY food.food_id"); 
	 		$stmt->execute(); 
	 		$result = $stmt->fetchAll();
	 		return $result;
    	}

    	public function displayImage($foodId){
    		$stmt = $this->conn->prepare("SELECT * from food WHERE food_id=$foodId"); 
	 		$stmt->execute(); 
	 		$result = $stmt->fetchAll();
			header('Content-Type: image/jpeg');
			return $result;
		}

		public function getAllFoods(){
			$stmt = $this->conn->prepare("SELECT * FROM food"); 
	 		$stmt->execute(); 
	 		$result = $stmt->fetchAll();
	 		return $result;
		}

		public function addNewFood($foodRelated, $attributeName){
			//CHECK IF EXISTING
			$stmt = $this->conn->prepare("SELECT * FROM attribute WHERE attribute.attribute_name LIKE '%$attributeName%'"); 
	 		$stmt->execute(); 
	 		$result = $stmt->fetchAll();
	 		//EXIST
	 		if(count($result) > 0){
	 			echo "<script>
	 				alert('already in the db');
	 			</script>";
	 		}
	 		//NOT EXIST
	 		else{
	 		//INSERT TO EMOTION
				$insertStmt = $this->conn->prepare("INSERT INTO attribute(attribute_name) VALUE('$attributeName')"); 
				$insertStmt->execute();
				//QUERY LAST ROW
				$lastRowStmt = $this->conn->prepare("SELECT attribute_id FROM attribute ORDER BY attribute_id DESC LIMIT 1");
				$lastRowStmt->execute();
				$result = $lastRowStmt->fetch();
				$lastId = $result['attribute_id'];
				//INSERT TO EMOOTION_FOODATTRIBUTE
				foreach ($foodRelated as $foodId) {
					$insertAttrFoodStmt = $this->conn->prepare("INSERT INTO attribute_food(attribute_id,food_id) VALUE($lastId, $foodId)");
					$insertAttrFoodStmt->execute();
				}
				echo "<script>
 						alert('Successfully added!');
 						window.location = 'attribute-list.php';
 					  </script>";
	 		} 
		}

		public function displayAttributes(){
    		$stmt = $this->conn->prepare("SELECT DISTINCT(attribute.attribute_name), attribute.attribute_id FROM attribute, attribute_food, food WHERE attribute.attribute_id = attribute_food.attribute_id AND attribute_food.food_id= food.food_id"); 
	 		$stmt->execute(); 
	 		$result = $stmt->fetchAll();
	 		return $result;
    	}

    	public function getFood($id){
    		$stmt = $this->conn->prepare("SELECT * FROM attribute_food, food WHERE attribute_food.attribute_id = $id AND attribute_food.food_id= food.food_id"); 
	 		$stmt->execute(); 
	 		$result = $stmt->fetchAll();
	 		return $result;
    	}

    	public function addFood($img, $attributes,$locations,$description,$foodName){
			//CHECK IF EXISTING
			$stmt = $this->conn->prepare("SELECT * FROM food WHERE food.food_name LIKE '%$foodName%'"); 
	 		$stmt->execute(); 
	 		$result = $stmt->fetchAll();
	 		//EXIST
	 		if(count($result) > 0){
	 			echo "<script>
	 				alert('already in the db');
	 			</script>";
	 		}
	 		//NOT EXIST
	 		else{
	 		//INSERT TO EMOTION
	 			$imagetmp = addslashes(file_get_contents($img));

				$insertStmt = $this->conn->prepare("INSERT INTO food(food_name,food_img,food_description) VALUE('$foodName','$imagetmp','$description')"); 
				$insertStmt->execute();
				//QUERY LAST ROW
				$lastRowStmt = $this->conn->prepare("SELECT food_id FROM food ORDER BY food_id DESC LIMIT 1");
				$lastRowStmt->execute();
				$result = $lastRowStmt->fetch();
				$lastId = $result['food_id'];
				//INSERT TO EMOOTION_FOODATTRIBUTE
				foreach ($attributes as $attribute) {
					$insertFoodAttrStmt = $this->conn->prepare("INSERT INTO attribute_food(attribute_id,food_id) VALUE($attribute, $lastId)");
					$insertFoodAttrStmt->execute();
				}
				foreach ($locations as $location) {
					$insertFoodLocationStmt = $this->conn->prepare("INSERT INTO food_location(food_id,location_id) VALUE($lastId, $location)");
					$insertFoodLocationStmt->execute();
				}
				echo "<script>
 						alert('Successfully added!');
 						window.location = 'food-list.php';
 					  </script>";
	 		} 
		}

		public function getFoodAttributes($id){
    		$stmt = $this->conn->prepare("SELECT * FROM attribute,attribute_food, food WHERE food.food_id = $id AND attribute_food.food_id= food.food_id AND attribute_food.attribute_id = attribute.attribute_id"); 
	 		$stmt->execute(); 
	 		$result = $stmt->fetchAll();
	 		return $result;
    	}

    	public function getSpecificFood($id){
    		$stmt = $this->conn->prepare("SELECT * FROM food WHERE food.food_id = $id"); 
	 		$stmt->execute(); 
	 		$result = $stmt->fetchAll();
	 		return $result;
    	}

    	public function isExist($username, $password){
    		$stmt = $this->conn->prepare("SELECT * FROM users WHERE users.username = '$username' AND users.password=md5('$password')"); 
	 		$stmt->execute();
	 		$exist = $stmt->rowCount();
	 		return $exist;
    	}

    	public function login($username, $password){
    		$stmt = $this->conn->prepare("SELECT * FROM users WHERE users.username = '$username' AND users.password=md5('$password')"); 
	 		$stmt->execute();
	 		$exist = $stmt->rowCount();
 			$result = $stmt->fetch(); 			
 			$_SESSION['loggedIn'] =  true;
 			$_SESSION['userId'] = $result['user_id'];
 			$_SESSION['firstName'] = $result['first_name'];
 			$_SESSION['lastName'] = $result['last_name'];
 			header("location: ./dashboard.php");
    	}

    	public function isLogin(){
    		if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true ){
    		}
    		else{
    			echo "
    				<script>
    					alert('Unauthorized access! Please login to continue!');
    					window.location = './index.php';
    				</script>
    			";
    		}
    	}

    	public function getAdminDetails(){
    		$userId = $_SESSION['userId'];
    		$stmt = $this->conn->prepare("SELECT * FROM users WHERE users.user_id = $userId"); 
	 		$stmt->execute();
	 		$exist = $stmt->rowCount();
 			$result = $stmt->fetch();
 			return $result;
    	}

    	public function updatePassUser($username, $password){
    		$userId = $_SESSION['userId'];
    		$stmt = $this->conn->prepare("UPDATE users SET users.username = '$username', password=md5('$password') WHERE users.user_id = $userId"); 
	 		$stmt->execute();
	 		$_SESSION['loggedIn'] = false;
	 		session_unset($_SESSION['loggedIn'], $_SESSION['userId'], $_SESSION['firstName'], $_SESSION['lastName']); 
			session_destroy(); 
	 		echo "<script>
					alert('Password/Username updated!');
					alert('Please login to continue!');
					window.location = 'index.php';
				  </script>";
    	}

    	public function getAllLocations(){
			$stmt = $this->conn->prepare("SELECT * FROM location"); 
	 		$stmt->execute(); 
	 		$result = $stmt->fetchAll();
	 		return $result;
		}
		public function getSpecificLocation($id){
			$stmt = $this->conn->prepare("SELECT * FROM location WHERE location.location_id = $id"); 
	 		$stmt->execute(); 
	 		$result = $stmt->fetch();
	 		return $result;
		}
		public function getLocationDetails($id){
			$stmt = $this->conn->prepare("SELECT * FROM location,food,food_location WHERE food.food_id=$id AND food.food_id = food_location.food_id AND food_location.location_id = location.location_id"); 
	 		$stmt->execute(); 
	 		$result = $stmt->fetchAll();
	 		return $result;
		}
		public function addLocation($img, $lat,$locationName,$lang,$address){
			//CHECK IF EXISTING
			$stmt = $this->conn->prepare("SELECT * FROM location WHERE location.location_name LIKE '%$locationName%'"); 
	 		$stmt->execute(); 
	 		$result = $stmt->fetchAll();
	 		//EXIST
	 		if(count($result) > 0){
	 			echo "<script>
	 				alert('already in the db');
	 			</script>";
	 		}
	 		//NOT EXIST
	 		else{
	 		//INSERT TO EMOTION
	 			$imagetmp = addslashes(file_get_contents($img));

				$insertStmt = $this->conn->prepare("INSERT INTO location(location_name,location_img,lat,lang,address) VALUE('$locationName','$imagetmp','$lat', '$lang','$address')"); 
				$insertStmt->execute();
				echo "<script>
							alert('Successfully added!');
							window.location = 'location-list.php';
						  </script>";
	 		} 
		}
	}





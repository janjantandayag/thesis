<?php	
	
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
	}





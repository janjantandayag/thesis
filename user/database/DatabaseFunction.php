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

		public function displayEmotions(){
    		$stmt = $this->conn->prepare("SELECT * FROM emotion"); 
	 		$stmt->execute(); 
	 		$result = $stmt->fetchAll();
	 		return $result;
    	}

        public function getFoodDetails($id){
            $stmt = $this->conn->prepare("SELECT * from food, food_location, location WHERE food.food_id = $id AND food.food_id = food_location.food_id AND food_location.location_id = location.location_id"); 
            $stmt->execute(); 
            $result = $stmt->fetch();
            return $result;
        }
        public function getFoodLocation($id){
            $stmt = $this->conn->prepare("SELECT * from food, food_location, location WHERE food.food_id = $id AND food.food_id = food_location.food_id AND food_location.location_id = location.location_id"); 
            $stmt->execute(); 
            $result = $stmt->fetchAll();
            return $result;
        }

        public function getNumLocation($id){
            $stmt = $this->conn->prepare("SELECT * from food, food_location, location WHERE food.food_id = $id AND food.food_id = food_location.food_id AND food_location.location_id = location.location_id"); 
            $stmt->execute();
            $count = $stmt->rowCount();
            return $count;
        }
    	public function getNumEmotion(){
    		$stmt = $this->conn->prepare("SELECT * FROM emotion"); 
    		$stmt->execute();
    		$count = $stmt->rowCount();
    		return $count;
    	}

    	public function getFoods($page, $emotionName){
    		$numOfRecPerPage = 10;
    		$startFrom = ($page-1) * $numOfRecPerPage;
    		$stmt = $this->conn->prepare("SELECT DISTINCT(food.food_id),food.food_name, food.food_description from emotion, attribute_emotion,attribute, attribute_food, food WHERE emotion.emotion_name LIKE '%$emotionName%' AND emotion.emotion_id = attribute_emotion.emotion_id AND attribute_emotion.attribute_id = attribute.attribute_id AND attribute.attribute_id = attribute_food.attribute_id AND attribute_food.food_id = food.food_id LIMIT $startFrom,$numOfRecPerPage"); 
    		$stmt->execute();
    		$result = $stmt->fetchAll();
    		return $result;
    	}

    	public function descriptionScreen($description){
    		$strLength = strlen($description);
    		if($strLength <= 150)
    		{
    			return $description;
    		}
    		else{
    			$description = substr($description, 0, 150);
    			return $description.' . . .';
    		}
    	}

    	public function pagination($emotionName){
    		$stmt = $this->conn->prepare("SELECT DISTINCT(food.food_id),food.food_name, food.food_description from emotion, attribute_emotion,attribute, attribute_food, food WHERE emotion.emotion_name LIKE '%$emotionName%' AND emotion.emotion_id = attribute_emotion.emotion_id AND attribute_emotion.attribute_id = attribute.attribute_id AND attribute.attribute_id = attribute_food.attribute_id AND attribute_food.food_id = food.food_id"); 
    		$stmt->execute();
    		$count = $stmt->rowCount();
    		$totalPages = ceil($count/10);
    		return $totalPages;
    	}
	}





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

		public function getFoodAttributes(){
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
					echo "<script>
	 						alert('Successfully added!');
	 					  </script>";
				}
	 		} 
    	}
	}





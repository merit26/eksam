<?php

class FriendsManager {
	
	private $connection;
    private $user_id;
    
    function __construct($mysqli, $id){
        
        $this->connection = $mysqli;
        $this->user_id = $id;
	
	}
	
	function getAllFriends($keyword = ""){
		if($keyword == ""){
			$search = "%%";	
		}else{
			$search = "%".$keyword."%";
		}
			
		$stmt = $this->connection->prepare("SELECT id, email, first_name, last_name, yearofbirth, yearofbirthstart, yearofbirthend FROM users");
		//$stmt->bind_param("i", $this->user_id);
		echo $this->connection->error;
		$stmt->bind_result($id_from_db, $email_from_db, $first_name_from_db, $last_name_from_db, $yearofbirth_from_db, $yearofbirthstart_from_db, $yearofbirthend_from_db);
		$stmt->execute();
		
		$array = array();
		
		while($stmt->fetch()){
			
			$friend = new Stdclass();
			
			$friend->id = $id_from_db;
			$friend->email = $email_from_db;
			$friend->first_name = $first_name_from_db;
			$friend->last_name = $last_name_from_db;
			$friend->yearofbirth = $yearofbirth_from_db;
			$friend->yearofbirthstart = $yearofbirthstart_from_db;
			$friend->yearofbirthend = $yearofbirthend_from_db;
						
			array_push($array, $friend);
		}
		
		return $array;
		
		$stmt->close();
	}
	
	
		
}

?>
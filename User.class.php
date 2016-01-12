<?php
class User {
	
	private $connection;
	
	function __construct($mysqli){
		
		$this->connection = $mysqli;
		
	}
	
	function loginUser($email, $hash){
		
		$response = new StdClass();
		
		$stmt = $this->connection->prepare("SELECT id, first_name, last_name, email FROM users WHERE email=? AND password=?");
		$stmt->bind_param("ss", $email, $hash);
		$stmt->bind_result($id_from_db, $first_name_from_db, $last_name_from_db, $email_from_db);
		$stmt->execute();
		
		if($stmt->fetch()){
			
			$success = new StdClass();
			$success->message = "Kasutaja edukalt sisse logitud";
			
			$user = new StdClass();
			$user->id = $id_from_db;
			$user->first_name = $first_name_from_db;
			$user->last_name = $last_name_from_db;
			$user->email = $email_from_db;
			
			$success->user = $user;
			$response->success = $success;
			
		}else{
			
			$error = new StdClass();
			$error->id = 1;
			$error->message = "Vale parool!";
			
			$response->error = $error;
			
		}
		
		$stmt->close();
		
		return $response;
	}	
	
	function createUser($create_user_email, $hash, $first_name, $last_name, $yearofbirth, $yearofbirthstart, $yearofbirthend){
		
		$response = new StdClass();

		$stmt = $this->connection->prepare("INSERT INTO users (email, password, first_name, last_name, yearofbirth, yearofbirthstart, yearofbirthend) VALUES (?,?,?,?,?,?,?)");
		$stmt->bind_param ("ssssiii", $create_user_email, $hash, $first_name, $last_name, $yearofbirth, $yearofbirthstart, $yearofbirthend);
		
		if($stmt->execute()){
			$success = new StdClass();	
			$success->message = "Kasutaja edukalt salvestatud";	
		    $response->success = $success;
		}else{
			$error = new StdClass();
			$error->id = 1;
			$error->message = "Midagi läks katki!";
			$response->error = $error;
		};
		
		$stmt->close();
		return $response;
	}
}
	
?>
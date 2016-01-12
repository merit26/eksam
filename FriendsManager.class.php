<?php

class FriendManager {
	
	private $connection;
    private $user_id;
    
    function __construct($mysqli, $user_id){
        
        $this->connection = $mysqli;
        $this->user_id = $user_id;
	
	}
	
	function getAllData($keyword = ""){
		
		if($keyword == ""){
			$search = "%%";	
		}else{
			$search = "%".$keyword."%";
		}
		
		$stmt = $this->connection->prepare("SELECT request_ID, company_ID, company_name, text_type, subject, description, target_group, source, length, offer_deadline, work_deadline, output, status, requests.created FROM requests JOIN users ON users.user_id=requests.company_id WHERE requests.deleted IS NULL AND (request_ID LIKE ? OR company_ID LIKE ? OR company_name LIKE ? OR text_type LIKE ? OR subject LIKE ? OR description LIKE ? OR target_group LIKE ? OR source LIKE ? OR length LIKE ? OR offer_deadline LIKE ? OR work_deadline LIKE ? OR output LIKE ? OR status LIKE ? OR requests.created LIKE ?)");
		$stmt->bind_param("iissssssssssss", $id_from_db, $company_id_from_db, $search, $search, $search, $search, $search, $search, $search, $search, $search, $search, $search, $search);
		$stmt->bind_result($id_from_db, $company_id_from_db, $company_name_from_db, $text_type_from_db, $subject_from_db, $description_from_db, $target_group_from_db, $source_from_db, $length_from_db, $offer_deadline_from_db, $work_deadline_from_db, $output_from_db, $status_from_db, $created_from_db);
		$stmt->execute();
		
		$array = array();
		
		while($stmt->fetch()){
			
			$order = new Stdclass();
			
			$order->request_ID = $id_from_db;
			$order->company_id = $company_id_from_db;
			$order->company_name = $company_name_from_db;
			$order->text_type = $text_type_from_db;
			$order->subject = $subject_from_db;
			$order->target_group = $target_group_from_db;
			$order->description = $description_from_db;
			$order->source = $source_from_db;
			$order->length = $length_from_db;
			$order->offer_deadline = $offer_deadline_from_db;
			$order->work_deadline = $work_deadline_from_db;
			$order->output = $output_from_db;
			$order->status = $status_from_db;
			$order->created = $created_from_db;
			
			array_push($array, $order);
		}
		
		return $array;
		
		$stmt->close();
	}
	
	function getSingleOrderData($id){
		
		$stmt = $this->connection->prepare("SELECT text_type, subject, description, target_group, source, length, offer_deadline, work_deadline, output FROM requests WHERE request_ID=? AND company_ID=? AND deleted IS NULL");
		$stmt->bind_param("ii", $id, $_SESSION["logged_in_user_id"]);
		$stmt->bind_result($text_type_from_db, $subject_from_db, $description_from_db, $target_group_from_db, $source_from_db, $length_from_db, $offer_deadline_from_db, $work_deadline_from_db, $output_from_db);
		$stmt->execute();
		
		$order = new Stdclass();
		
		if($stmt->fetch()){
			$order->text_type = $text_type_from_db;
			$order->subject = $subject_from_db;
			$order->target_group = $target_group_from_db;
			$order->description = $description_from_db;
			$order->source = $source_from_db;
			$order->length = $length_from_db;
			$order->offer_deadline = $offer_deadline_from_db;
			$order->work_deadline = $work_deadline_from_db;
			$order->output = $output_from_db;
		}else{
			header("Location: requests.php");
		}
		
		$stmt->close();
        
        return $order;
	
		}

		
}

?>
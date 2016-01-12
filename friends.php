<?php
	require_once("functions.php");
	require_once("FriendsManager.class.php");
	
	
	$FriendsManager = new FriendsManager($mysqli, $_SESSION["logged_in_user_id"]);
	
	$keyword = "";
	
	if(isset($_GET["keyword"])){
		$keyword = $_GET["keyword"];
		$friends_array = $FriendsManager->getAllFriends($keyword);
	}else{
		$friends_array = $FriendsManager->getAllFriends();
	}
	
	
	
	function cleanInput($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
	}
	

     $friends_array = $FriendsManager->getAllFriends(); 
 ?>

<h3>Otsing</h3>

<form action="requests.php" method="get">
	<input name="keyword" type="search" value="<?=$keyword?>">
	<input type="submit" value="otsi">
</form><br>
 
<h1>Tabel</h1> 

<table border=1> 
<tr> 
<th>id</th> 
<th>email</th> 
<th>eesnimi</th> 
<th>perenimi</th> 
<th>sünniaasta</th> 
<th>algus</th> 
<th>lõpp</th> 
</tr> 
<?php  
      
     // autod ükshaaval läbi käia 
for($i = 0; $i < count($friends_array); $i++){ 

             echo "<tr>"; 
             echo "<td>".$friends_array[$i]->id."</td>";
			 echo "<td>".$friends_array[$i]->email."</td>"; 
             echo "<td>".$friends_array[$i]->first_name."</td>"; 
             echo "<td>".$friends_array[$i]->last_name."</td>"; 
             echo "<td>".$friends_array[$i]->yearofbirth."</td>"; 
			 echo "<td>".$friends_array[$i]->yearofbirthstart."</td>"; 
             echo "<td>".$friends_array[$i]->yearofbirthend."</td>"; 
             
                          echo "</tr>"; 
              
         } 
          
           
          
           
?> 
</table> 

<?php	

	require_once("functions.php");

	$create_user_email_error = "";
	$create_user_password_error = "";
	$first_name_error = "";
	$last_name_error = "";
	$yearofbirth_error = "";
	$yearofbirthstart_error = "";
	$yearofbirthend_error = "";
	
	$create_user_email = "";
	$create_user_password = "";
	$first_name = "";
	$last_name = "";
	$yearofbirth = "";
	$yearofbirthstart = "";
	$yearofbirthend = "";
		
	
	if($_SERVER["REQUEST_METHOD"] == "POST") {
		
		if(isset($_POST["create_user"])){

				
			if(empty($_POST["create_user_email"])) {
				$create_user_email_error = "Ei saa olla tühi";
			} else {
				$create_user_email = cleanInput($_POST["create_user_email"]);
			}
			
			if(empty($_POST["create_user_password"])) {
				$create_user_password_error = "Ei saa olla tühi";
			} elseif(strlen($_POST["create_user_password"]) < 8) {
					$create_user_password_error = "Peab olema vähemalt 8 sümbolit pikk";
			} else {
				$create_user_password = cleanInput($_POST["create_user_password"]);
			}
			
			if(empty($_POST["first_name"])) {
				$first_name_error = "Ei saa olla tühi";
			} else {
				$first_name = cleanInput($_POST["first_name"]);
			}
			
			if(empty($_POST["last_name"])) {
				$last_name_error = "Ei saa olla tühi";
			} else {
				$last_name = cleanInput($_POST["last_name"]);
			}
			
				
			if(empty($_POST["yearofbirth"])) {
				$yearofbirth_error = "Ei saa olla tühi";
			} else {
				$yearofbirth = cleanInput($_POST["yearofbirth"]);
			}
			
			if(empty($_POST["yearofbirthstart"])) {
				$yearofbirthstart_error = "Ei saa olla tühi";
			} else {
				$yearofbirthstart = cleanInput($_POST["yearofbirthstart"]);
			}
			
			if(empty($_POST["yearofbirthend"])) {
				$yearofbirthend_error = "Ei saa olla tühi";
			} else {
				$yearofbirthend = cleanInput($_POST["yearofbirthend"]);
			}
				
			}
			
	
			if($create_user_email_error == "" && $create_user_password_error == "" && $first_name_error == "" && $last_name_error == "" && $yearofbirth_error == "" && $yearofbirthstart_error == "" && $yearofbirthend_error == "" ){
					echo hash("sha512", $create_user_password);
					echo $first_name." ".$last_name." võib kasutaja luua! Kasutajanimi on ".$create_user_email." ja parool on ".$create_user_password;
					
					$hash = hash("sha512", $create_user_password);
					
					$create_response = $User->createUser($create_user_email, $hash, $first_name, $last_name, $yearofbirth, $yearofbirthstart, $yearofbirthend);
				}
			}
		}
	}
	
	function cleanInput($data){
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
	}

?>
<?php
	
	$page_title = "Create User";
	$page_file = "create_user.php"
	
?>
<?php require_once("header.php"); ?>
		
		<?php if(isset($create_response->error)):?>
			<p style="color:red;">
				<?=$create_response->error->message;?>
			</p>
		<?php elseif(isset($create_response->success)): ?>
			<p style="color:green;">
				<?=$create_response->success->message;?>
			</p>
		<?php endif; ?>
		
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
			
			<input name="create_user_email" type="email" placeholder="E-post" value="<?php echo $create_user_email; ?>">* <?php echo $create_user_email_error; ?> <br><br>
			<input name="create_user_password" type="password" placeholder="Parool">* <?php echo $create_user_password_error; ?> <br><br>	
			<input name="first_name" type="text" placeholder="Eesnimi" value="<?php echo $first_name; ?>">* <?php echo $first_name_error; ?> <br><br>
			<input name="last_name" type="text" placeholder="Perekonnanimi" value="<?php echo $last_name; ?>">* <?php echo $last_name_error; ?> <br><br>
			<input name="yearofbirth" type="text" placeholder="Sinu sünniaasta" value="<?php echo $dateofbirth; ?>">* <?php echo $dateofbirth_error; ?> <br><br>
			<input name="yearofbirthstart" type="text" placeholder="Vanima soovitud kirjasõbra sünniaasta" value="<?php echo $yearofbirthstart; ?>">* <?php echo $yearofbirthstart_error; ?> <br><br>
			<input name="yearofbirthend" type="text" placeholder="Noorima soovitud kirjasõbra sünniaasta" value="<?php echo $yearofbirthend; ?>">* <?php echo $yearofbirthend_error; ?> <br><br>
			<input name ="create_user" type="submit" value="Loo kasutaja">
		</form>
<?php require_once("footer.php"); ?>


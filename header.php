<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	
	<title>Kirjasõbrad</title>
	
</head>
<body>
	
	<ul>
		<li><a href="create_user.php">Loo kasutaja</a></li>
		<li><a href="login.php">Logi sisse</a></li>
		<li><a href="friends.php">Vaata kirjasõpru</a></li>
			
	</ul>
		<ul class="nav navbar-nav navbar-right">
			<li><a href=""><?=$_SESSION['logged_in_user_email'];?></a></li>
			<li><a href="?logout=1">[logi välja]</a></li>
		</ul>
</body>	
</html>	

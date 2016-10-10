<!DOCTYPE html>
<html>
<head>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet" type="text/css">
	<script style="text/javascript" src="js/js.js"></script>
	
	<title>TAI 42</title>
	
</head>
<body>
	<div id="loginform">
	<img src="img/logo.jpg">
		<form method="post" action="security/autenticate.php">
			<input type="text" placeholder="Business id" name="bid"></input><br>
			<input type="text" placeholder="Email" name="email"></input><br>
			<input type="password" placeholder="Password" name="password"></input><br>
			<input type="submit" value="Login"></input>
		</form>
		<a href="register.php">Registrar!</a>
	</div>
</body>
</html>
<!DOCTYPE html>
<html>
<head>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet" type="text/css">
	<script style="text/javascript" src="js/js.js"></script>

	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
	

	<?php //include("security/autenticate.php"); ?>
	
	<title>TAI 42</title>
	
</head>
<body>

	<form id="register" action="#" method="post">
		<label>Dados da Empresa</label><br><br>
		<!--company_cod-->
		<input name="company_name" placeholder="Nome da Empresa"></input>
		<input name="company_address" placeholder="Endere&ccedil da Empresa"></input>
		<input name="company_city" placeholder="Cidade"></input>
		<input name="company_state" placeholder="Estado"></input>
		<input name="company_country" placeholder="Pa&iacute;s"></input>
		<input name="company_zipcode" placeholder="CEP"></input>
		<!--date_reg-->
		<!--company_active-->
		<br><br>
		<label>Dados do administrador</label><br><br>
		<input name="user_email" placeholder="Email" type="email"></input>
		<input name="user_password" placeholder="Senha" type="password"></input>
		<input name="reptuser_password" placeholder="Repetir a senha" type="password"></input>
		<!--user_datereg-->
		<!--user_active-->
		<input name="user_name" placeholder="Nome do Administrador"></input>
		<!--<input name="user_birthdate" placeholder=""></input>
		<input name="user_position" placeholder=""></input>
		<input name="user_description" placeholder=""></input>
		<input name="user_department" placeholder=""></input>
		<input name="user_telephone" placeholder=""></input>
		<input name="user_extline" placeholder=""></input>
		<input name="user_idiom" placeholder=""></input>
		<input name="user_cellphone" placeholder=""></input>-->
		<input type="submit" value="Registrar!" onClick="return validar"></input>
		
		
		
		
	</form>

</body>
</html>
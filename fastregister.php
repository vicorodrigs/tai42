<?php include("security/autenticate.php"); ?>
<?php include("functions.php"); ?>
<?php
	if(isset($_POST['action_description']) AND isset($_POST['action_datedeadline'])){
		conecta();
		
		$sql = "SELECT * FROM tblUsersLogin WHERE company_cod = " . $_SESSION['company_cod'] . " AND user_name = '" . $_POST['action_responsable'] . "'";
		//echo $sql;
		$result = mysql_query($sql) or die("erro ao selecionar");

	// Verifica se usuario existe

	if (mysql_num_rows($result) <=0){
			echo "<script>alert('Por favor, selecionar usuário valido!');</script>";
		} else {
			$value = mysql_fetch_object($result);
			$userresp_cod = $value->user_cod;
			
			$sql = null;
			$result = null;
			
			$sql = "INSERT INTO tblActionList (company_cod, userreg_cod, userresp_cod, action_datereg, action_description, action_why, action_where, action_datedeadline) VALUES ('" . $_SESSION['company_cod'] . "', '" . $_SESSION['user_cod'] . "', '" . $userresp_cod  . "', CURDATE(),'" . $_POST['action_description'] . "', '". $_POST['action_why'] . "', '" . $_POST['action_where'] ."', '". date_format(date_create($_POST['action_datedeadline']),'Y-m-d') ."')";
			//echo $sql;
			$result = mysql_query($sql) or die("erro ao selecionar");
			//$conn->close();
		}
	}
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <!-- Title -->
        <title>TAI 42</title>
        
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
        <meta name="description" content="Responsive Admin Dashboard Template" />
        <meta name="keywords" content="admin,dashboard" />
        <meta name="author" content="Steelcoders" />
		<meta charset="UTF-8_bin">
		<!--<meta charset="ISO-8859-1">-->
        
        <!-- Styles -->
        <link type="text/css" rel="stylesheet" href="assets/plugins/materialize/css/materialize.min.css"/>
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">    
        <link href="assets/plugins/metrojs/MetroJs.min.css" rel="stylesheet">
        <link href="assets/plugins/weather-icons-master/css/weather-icons.min.css" rel="stylesheet">
		<link rel="icon" sizes="192x192" href="nice-highres.png">

        <!-- Theme Styles -->
        <link href="assets/css/alpha.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/css/custom.css" rel="stylesheet" type="text/css"/>
        
        
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="http://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="http://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        
    </head>
	    <body>
		<?php include_once("analyticstracking.php") ?>


            <main class="mn-inner">
                <div  style="width:100%;height:100%;">
                    <div class="col s6" style="width:100%;height:100%;"></div>
                    <div class="col s5 m6 l6">
                        <div class="card">
							<div class="card-content" id="inputactions">
							 <span class="card-title">Inserir a&ccedil;&otilde;es</span>
							 <div class="row">
                                    <form class="col s12" action="actions.php" method="post" name="insertNewAction">
                                        <div class="row">
                                            <div class="input-field col">
                                                <input id="action_why" name="action_why" type="text" class="validate">
                                                <label for="action_why">Causa</label>
                                            </div>
                                            <!--<div class="input-field col s2">-->
                                            <div class="input-field col">
                                                <input id="action_description" name="action_description" type="text" class="validate">
                                                <label for="action_description">A&ccedil;&atilde;o</label>
                                            </div>
                                            <div class="input-field col">
                                                <input id="action_responsable" name="action_responsable" type="text" class="validate autocompletewho">
                                                <label for="action_responsable">Respons&aacute;vel</label>
                                            </div>
                                            <div class="input-field col">
                                                <label for="action_datedeadline">Prazo</label>
												<input id="action_datedeadline" name="action_datedeadline" type="text" class="datepicker">
                                            </div>
                                            <div class="input-field col">
                                                <input id="action_where" name="action_where" type="text" class="validate autocompletewhere">
                                                <label for="action_where">Onde</label>
                                            </div>
                                            <div class="input-field col">
												<input type="submit" class="waves-effect waves-light btn teal" value="Adicionar!"> </input>
                                            </div>
                                        </div>
                                    </form>
                                </div>
							</div>
							</div>
                    </div>
                </div>
            </main>
            </div>
        </div>
        <div class="left-sidebar-hover"></div>
        
        <!-- Javascripts -->
        <script src="assets/plugins/jquery/jquery-2.2.0.min.js"></script>
        <script src="assets/plugins/materialize/js/materialize.min.js"></script>
        <script src="assets/plugins/material-preloader/js/materialPreloader.min.js"></script>
        <script src="assets/plugins/jquery-blockui/jquery.blockui.js"></script>
        <script src="assets/plugins/datatables/js/jquery.dataTables.min.js"></script>
        <script src="assets/js/alpha.min.js"></script>
        <script src="assets/js/pages/table-data.js"></script>
        <script src="assets/js/pages/form-elements.js"></script>
        <script src="assets/js/custom.js"></script>

		
        
		<?php 
			conecta();
			$sql = "SELECT action_where FROM tblActionList WHERE company_cod = " . $_SESSION['company_cod'] . " GROUP BY action_where ORDER BY action_where ASC";
			$result = mysql_query($sql) or die("erro ao selecionar");
			if (mysql_num_rows($result) > 0) {
				// output data of each row
				while($row = mysql_fetch_array($result)) {
					$where = $where . "\"" . $row['action_where'] . "\": null, ";
				}
				//echo $where . "<br><br>";
			} 
			$sql = "SELECT user_name, user_cod FROM tblUsersLogin WHERE company_cod = " . $_SESSION['company_cod'] . " GROUP BY user_name, user_cod ORDER BY user_name ASC";
			$result = mysql_query($sql) or die("erro ao selecionar");
			if (mysql_num_rows($result) > 0) {
				// output data of each row
				while($row = mysql_fetch_array($result)) {
					$who = $who . "\"" . $row['user_name'] . "\": null, ";
				}
				//echo $who;
			} 
		?>

				<script>
			<?php
			echo "
				$(document).ready(function(){
				$('.datepicker').pickadate({
					selectMonths: true, // Creates a dropdown to control month
					selectYears: 15 // Creates a dropdown of 15 years to control year
				});
				$('input.autocompletewho').autocomplete({
					data: {". $who . "
					}
				  });
			$('input.autocompletewhere').autocomplete({
				data: {
				  ". $where . "
				}
			  });
			$('input.autocompletewhere2').autocomplete({
				data: {
				  \"Apple\": null,
				  \"Microsoft\": null,
				  \"Google\": 'assets/images/google.png',
				}
			  });
			});";
					?>

		// Disable autocomplete
		someForm = document.insertNewAction;
		someForm.setAttribute("autocomplete", "off");

					
		</script>

    </body>
</html>
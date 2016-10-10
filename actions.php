<?php include("security/autenticate.php"); ?>
<?php include("lang/actions.php"); ?>
<?php include("functions.php"); ?>
<?php
	if(isset($_POST['action_description']) AND isset($_POST['action_datedeadline'])){
		conecta();
		
		$sql = "SELECT * FROM tblUsersLogin WHERE company_cod = " . $_SESSION['company_cod'] . " AND user_name = '" . $_POST['action_responsable'] . "'";
		//echo $sql;
		$result = mysql_query($sql) or die($error);

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
<?php include("header.php"); ?>



            <main class="mn-inner">
                <div class="row">
                    <div class="col s12">
                        <div class="page-title"><?php echo $title ?> - <?php echo $_SESSION['lang'];?></div>
                    </div>
                    <div class="col s12 m12 l12">
                        <div class="card">
							<div class="card-content" id="inputactions">
							 <span class="card-title"><?php echo $insertActions; ?></span>
							 <div class="row">
                                    <form class="col s12" action="actions.php" method="post" name="insertNewAction">
                                        <div class="row">
                                            <div class="input-field col">
                                                <input id="action_why" name="action_why" type="text" class="validate">
                                                <label for="action_why"><?php echo $causa; ?></label>
                                            </div>
                                            <!--<div class="input-field col s2">-->
                                            <div class="input-field col">
                                                <input id="action_description" name="action_description" type="text" class="validate">
                                                <label for="action_description"><?php echo $acao; ?></label>
                                            </div>
                                            <div class="input-field col">
                                                <input id="action_responsable" name="action_responsable" type="text" class="validate autocompletewho">
                                                <label for="action_responsable"><?php echo $responsavel; ?></label>
                                            </div>
                                            <div class="input-field col">
                                                <label for="action_datedeadline"><?php echo $prazo; ?></label>
												<input id="action_datedeadline" name="action_datedeadline" type="text" class="datepicker">
                                            </div>
                                            <div class="input-field col">
                                                <input id="action_where" name="action_where" type="text" class="validate autocompletewhere">
                                                <label for="action_where"><?php echo $onde; ?></label>
                                            </div>
                                            <div class="input-field col">
												<input type="submit" class="waves-effect waves-light btn teal" <?php echo $adicionar; ?>> </input>
                                            </div>
                                        </div>
                                    </form>
                                </div>
							</div>
							</div>
							<div class="card">
                            <div class="card-content">
                                <table id="example" class="display datatable-example">
                                <!--<table id="example" class="display responsive-table datatable-example">-->
                                    <thead>
                                        <tr>
                                            <th><?php echo $causa; ?></th>
                                            <th><?php echo $acao; ?></th>
                                            <th><?php echo $responsavel; ?></th>
											<th><?php echo $onde; ?></th>
                                            <th><?php echo $prazo; ?></th>
                                            <th><?php echo $realizado; ?></th>
                                            <th><?php echo $status; ?></th>
                                            <th><?php echo $editar; ?></th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th><?php echo $causa; ?></th>
                                            <th><?php echo $acao; ?></th>
                                            <th><?php echo $responsavel; ?></th>
											<th><?php echo $onde; ?></th>
                                            <th><?php echo $prazo; ?></th>
                                            <th><?php echo $realizado; ?></th>
                                            <th><?php echo $status; ?></th>
                                            <th><?php echo $editar; ?></th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
										<?php
											/*
											$iconconclui1 = "<a class='iconAction' onClick='concluir(";
											$iconconclui2 = ")'><i class='material-icons' title='Concluir a&ccedil;&atilde;o'>&#xE876;</i></a>";
											$iconcancela1 = "<a class='iconAction' onClick='cancelar(";
											$iconcancela2 = ")'><i class='material-icons' title='Cancelar a&ccedil;&atilde;o'>&#xE14C;</i></a>";
											$iconexclui1 = "<a class='iconAction' onClick='deletar(";
											$iconexclui2 = ")'><i class='material-icons' title='Deletar a&ccedil;&atilde;o'>&#xE872;</i></a>";
											$iconreativa1 = "<a class='iconAction' onClick='reviver(";
											$iconreativa2 = ")'><i class='material-icons' title='Reativar a&ccedil;&atilde;o'>&#xE042;</i></a>";
											*/
											
											$iconconclui1 = "<a class='iconAction' href='?concluir=";
											$iconconclui2 = "'><i class='material-icons' title='". $concluir ."'>&#xE876;</i></a>";
											$iconcancela1 = "<a class='iconAction' href='?cancelar=";
											$iconcancela2 = "'><i class='material-icons' title='". $cancelar ."'>&#xE14C;</i></a>";
											$iconexclui1 = "<a class='iconAction' href='?deletar=";
											$iconexclui2 = "'><i class='material-icons' title='". $deletar ."'>&#xE872;</i></a>";
											$iconreativa1 = "<a class='iconAction' href='?reviver=";
											$iconreativa2 = "'><i class='material-icons' title='". $reativar  ."'>&#xE042;</i></a>";
											
											conecta();
											$sql = "SELECT tblActionList.*, tblUsersLogin.user_name, DATEDIFF(CURDATE(), tblActionList.action_datedeadline) as datestatus FROM tblActionList INNER JOIN tblUsersLogin ON tblActionList.userresp_cod = tblUsersLogin.user_cod WHERE tblActionList.company_cod = " . $_SESSION['company_cod'] . " ORDER BY tblActionList.action_cod ASC";
											$result = mysql_query($sql) or die("erro ao selecionar");
											if (mysql_num_rows($result) > 0) {
												// output data of each row
												while($row = mysql_fetch_array($result)) {
													if($row['action_canceled'] == 1){
														$action_status = 0;
														$action_status_descr = "A&ccedil;&atilde;o cancelada";
														$action_icon = $iconexclui1 . $row['action_cod'] . $iconexclui2 . " " . 		$iconreativa1 .	$row['action_cod'] . $iconreativa2;
													} elseif($row['action_dateconclusion'] > 0) {
														$action_status = 3;
														$action_status_descr = "A&ccedil;&atilde;o concluida";
														$action_icon = /*$iconexclui1 . $row['action_cod'] . $iconexclui2 . " " .*/		$iconreativa1 .	$row['action_cod'] . $iconreativa2;
													} elseif ($row['datestatus']>0) {
														$action_status = 1;
														$action_status_descr = "A&ccedil;&atilde;o atrasada";
														$action_icon = $iconconclui1 .	$row['action_cod'] . $iconconclui2. " " . $iconcancela1 .	$row['action_cod'] . $iconcancela2;
													} else {
														$action_status = 2;
														$action_status_descr = "A&ccedil;&atilde;o em andamento";
														$action_icon = $iconconclui1 .	$row['action_cod'] . $iconconclui2. " " . $iconcancela1 . $row['action_cod'] . $iconcancela2;
													}
														
													if ($row['action_datedeadline'] > 0) {
														$action_datedeadline = date_format(date_create($row['action_datedeadline']),'d/m/Y');
													} else {$action_datedeadline = "";}
													if ($row['action_dateconclusion'] > 0) {
														$action_dateconclusion = date_format(date_create($row['action_dateconclusion']),'d/m/Y');
														} else {$action_dateconclusion = "";}
														
													echo "<tr id='action-" . $row['action_cod'] . "'><td>" .
													$row['action_why'] . "</td><td>" .
													$row['action_description'] . "</td><td>" .
													$row['user_name'] . "</td><td>" .
													$row['action_where'] . "</td><td>" .
													/*$row['action_datedeadline'] ."</td><td>" .
													$row['action_dateconclusion'] . "</td><td>" .
													*/
													$action_datedeadline ."</td><td>" .
													$action_dateconclusion . "</td><td>" .
													"<center><i class='material-icons md-18 pastatus". $action_status ."' title='". $action_status_descr ."'>&#xE3A6;</i></center></td><td>" . $action_icon. "</td></tr>";
													
													
												}
											}
											//$conn->close();
											
											
											
											
										?>
                                    </tbody>
                                </table>
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
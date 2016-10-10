<?php include("security/autenticate.php"); ?>
<?php
	if(isset($_POST['user_name']) AND isset($_POST['user_password']) AND isset($_POST['Admin']) AND isset($_POST['user_email'])){
		conecta();
		
	// Verifica se ja existe usuario com esse nome
		$sql = "SELECT * FROM tblUsersLogin WHERE (user_name = '". $_POST['user_name'] . "' OR user_email = '" . $_POST['user_email'] . "') AND company_cod = '" . $_SESSION['company_cod'] . "'";
		$result = mysql_query($sql) or die("erro ao selecionar");
		if (mysql_num_rows($result) <=0){
			$userpass = md5($_POST['user_password']);
			//echo $_POST['user_name'] . " " . $_POST['user_password'] . " " . $_POST['Admin'] . " " . $_POST['user_email'];
			$sql = "INSERT INTO tblUsersLogin (user_email, company_cod, user_password, user_datereg, user_active, user_name, Admin) VALUES ('" . $_POST['user_email'] . "', '" . $_SESSION['company_cod'] . "', '" . $userpass . "', CURDATE(), '1', '". $_POST['user_name'] . "', '" . $_POST['Admin'] ."')";
			//echo $sql;
			$result = mysql_query($sql) or die("erro ao selecionar");
			//$conn->close();
		}
		else {
			echo "<script>alert('Ja existe usuario com esse nome e/ou email! Por favor, inserir um nome diferente!');</script>";	
		}
	}
?>
<?php include("header.php"); ?>
            <main class="mn-inner">
                <div class="row">
                    <div class="col s12">
                        <div class="page-title">Usu&aacute;rios</div>
                    </div>
                    <div class="col s12 m12 l12">
                        <div class="card">
							<?php if($_SESSION['Admin']==1){ ?>
							<div class="card-content" id="registerusers">
							 <span class="card-title">Inserir usu&aacute;rios</span>
							 <div class="row">
                                    <form class="col s12" method="post" action="#" autocomplete="nope" name="insertNewUser">
										<input autocomplete="nope" name="hidden" type="email" style="display:none;">
                                        <div class="row">
                                            <div class="input-field col s3">
                                                <input id="user_name" type="text" class="validate" name="user_name" autocomplete="nope">
                                                <label for="user_name">Nome</label>
                                            </div>
                                            <div class="input-field col s3">
                                                <input id="user_email" type="email" class="validate" name="user_email" autocomplete="nope">
                                                <label for="user_email">E-mail</label>
                                            </div>
                                            <div class="input-field col s2">
                                                <input id="user_password" type="password" class="validate" name="user_password" autocomplete="nope">
                                                <label for="user_password">Senha</label>
                                            </div>
                                            <div class="input-field col s2">
												<select name="Admin" id="Admin">
													<option value="" disabled selected>Administrador?</option>
													<option value="1">Sim</option>
													<option value="0">N&atilde;o</option>
												</select>
                                            </div>
                                            <div class="input-field col s2">
												<input type="submit" class="waves-effect waves-light btn teal" value="Adicionar!"> </input>
                                            </div>
                                        </div>
                                    </form>
                                </div>
							</div>
							</div>
							<div class="card">
							<?php } ?>
                            <div class="card-content">
                                <table id="example" class="display responsive-table datatable-example">
                                    <thead>
                                        <tr>
                                            <th>Nome</th>
                                            <th>E-mail</th>
                                            <!--<th>Ativo</th>-->
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Nome</th>
                                            <th>E-mail</th>
                                            <!--<th>Ativo</th>-->
                                        </tr>
                                    </tfoot>
                                    <tbody>
										<?php
											conecta();
											$sql = "SELECT * FROM tblUsersLogin WHERE company_cod = " . $_SESSION['company_cod'];
											$result = mysql_query($sql) or die("erro ao selecionar");
											if (mysql_num_rows($result) > 0) {
												// output data of each row
												while($row = mysql_fetch_array($result)) {
													if($_SESSION['Admin']==1 AND $row['user_active']==1){
														echo "<tr><td>" .
														$row['user_name'] . "</td><td>" .
														$row['user_email'] . "</td><td>" /*.
														"<div class='switch'><label>
														<input type='checkbox' checked><span class='lever'></span></label></div>"
														 . "</td>" */ . "</tr>";
													 } else if($_SESSION['Admin']==1 AND $row['user_active']==0){
														echo "<tr><td>" .
														$row['user_name'] . "</td><td>" .
														$row['user_email'] . "</td><td>" /*.
														"<div class='switch'><label>
														<input type='checkbox'><span class='lever'></span></label></div>"
														 . "</td>" */ . "</tr>";
														} else if($_SESSION['Admin']==0 AND $row['user_active']==1){
														echo "<tr><td>" .
														$row['user_name'] . "</td><td>" .
														$row['user_email'] . "</td><td>" /*.
														"<div class='switch'><label>
														<input type='checkbox' checked disabled><span class='lever'></span></label></div>"
														 . "</td>" */ . "</tr>";
														} else {
														echo "<tr><td>" .
														$row['user_name'] . "</td><td>" .
														$row['user_email'] . "</td><td>" /*.
														"<div class='switch'><label>
														<input type='checkbox' disabled><span class='lever'></span></label></div>"
														 . "</td>" */ . "</tr>";
														}
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
		
		<script>
			// Disable autocomplete
			someForm = document.insertNewUser;
			someForm.setAttribute("autocomplete", "off");
		</script>
        
    </body>
</html>
<?php

if(isset($_POST['userresp_cod']) && isset($_POST['action_why']) && isset($_POST['action_description']) && isset($_POST['action_where'])
	&& isset($_POST['action_howmuch']) && isset($_POST['action_datedeadline'])){
		conecta();
		$sqlInsertPa = "INSERT INTO tblActionList (company_cod, userreg_cod, action_datereg, userresp_cod, action_description, action_why, action_where, action_detedeadline, action_howmuch, action_canceled) VALUES ('". $_SESSION['company_cod'] ."','". $_SESSION['user_cod'] ."', DATE(NOW()), '" . $_POST['userresp_cod'] ."', '". $_POST['action_description'] ."', '". $_POST['action_why'] ."', '". $_POST['action_where'] ."', '". $_POST['action_datedeadline']."', '".$_POST['action_howmuch']."', 0)";
		$resultInsertPa = mysql_query($sqlInsertPa) or die("erro ao selecionar");
		
		/*
				$resultInsertPa = mysql_query($sqlInsertPa) or die("erro ao selecionar");
				
				if ($conn->query($sql) === TRUE) {
				echo "<script>alert('New record created successfully');";
				
				} else {
				echo "<script>alert('Error!');";
				}

				$conn->close();
				;
				*/
}

function clean($string) {
   $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.

   return preg_replace('/[^0-9\-]/', '', $string); // Removes special chars.
}

if (isset($_GET['concluir'])){
	if (strlen(clean($_GET['concluir']))>0) {
		conecta();
		$sqlconclude = "UPDATE tblActionList SET action_dateconclusion=DATE(NOW()) WHERE action_cod =" . clean($_GET['concluir']);
		$resultconclude = mysql_query($sqlconclude) or die("erro ao atualizar");
	}
}

if (isset($_GET['cancelar'])){
	if (strlen(clean($_GET['cancelar']))>0) {
		conecta();
		$sqlcancel = "UPDATE tblActionList SET action_canceled='1' WHERE action_cod =" . clean($_GET['cancelar']);
		$resultconclude = mysql_query($sqlcancel) or die("erro ao atualizar");
	}
}

if (isset($_GET['deletar'])){
	if (strlen(clean($_GET['deletar']))>0) {
		conecta();
		$sqlcancel = "DELETE FROM tblActionList WHERE action_cod =" . clean($_GET['deletar']);
		$resultconclude = mysql_query($sqlcancel) or die("erro ao atualizar");
	}
}

if (isset($_GET['reviver'])){
	if (strlen(clean($_GET['reviver']))>0) {
		conecta();
		$sqlcancel = "UPDATE tblActionList SET action_canceled='0', action_dateconclusion=null WHERE action_cod =" . clean($_GET['reviver']);
		$resultconclude = mysql_query($sqlcancel) or die("erro ao atualizar");
	}
}

?>


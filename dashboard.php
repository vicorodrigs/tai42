<?php include("security/autenticate.php"); ?>
<?php include('header.php'); ?>

			
            <main class="mn-inner">
                <div class="row">
                    <div class="col s12">
                        <div class="page-title">Dashboard</div>
                    </div>
                    <div class="col s12 m6 l4">
                        <div class="card">
                            <div class="card-content">
                                <span class="card-title">Status</span>
                                <div>
                                    <canvas id="chart1"></canvas>
                                </div>
                            </div>
                        </div>
					</div>
					<div class="col s12 m6 l4">
                        <div class="card">
                            <div class="card-content">
                                <span class="card-title">Ranking atrasos</span>
                                <div>
                                    <canvas id="chart2" ></canvas>
                                </div>
                            </div>
                        </div>
					</div>
					<!--
					<div class="col s12 m6 l4">
                        <div class="card">
                            <div class="card-content">
                                <span class="card-title">Bar Chart</span>
                                <div>
                                    <canvas id="chart3" width="200" height="100"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>-->
                </div>
            </main>
			
			
			
<!--
            <div class="page-footer">
                <div class="footer-grid container">
                    <div class="footer-l white">&nbsp;</div>
                    <div class="footer-grid-l white">
                        <a class="footer-text" href="ui-waves.html">
                            <i class="material-icons arrow-l">arrow_back</i>
                            <span class="direction">Previous</span>
                            <div>
                                Waves
                            </div>
                        </a>
                    </div>
                    <div class="footer-r white">&nbsp;</div>
                    <div class="footer-grid-r white">
                        <a class="footer-text" href="layout-boxed.html">
                            <i class="material-icons arrow-r">arrow_forward</i>
                            <span class="direction">Next</span>
                            <div>
                                Boxed Layout
                            </div>
                        </a>
                    </div>
                </div>
            </div>
-->
        </div>
        <div class="left-sidebar-hover"></div>
        
        <!-- Javascripts -->
        <script src="assets/plugins/jquery/jquery-2.2.0.min.js"></script>
        <script src="assets/plugins/materialize/js/materialize.min.js"></script>
        <script src="assets/plugins/material-preloader/js/materialPreloader.min.js"></script>
        <script src="assets/plugins/jquery-blockui/jquery.blockui.js"></script>
        <script src="assets/plugins/chart.js/chart.min.js"></script>
        <script src="assets/plugins/d3/d3.min.js"></script>
        <script src="assets/plugins/nvd3/nv.d3.min.js"></script>
        <script src="assets/plugins/flot/jquery.flot.min.js"></script>
        <script src="assets/plugins/flot/jquery.flot.time.min.js"></script>
        <script src="assets/plugins/flot/jquery.flot.symbol.min.js"></script>
        <script src="assets/plugins/flot/jquery.flot.resize.min.js"></script>
        <script src="assets/plugins/flot/jquery.flot.tooltip.min.js"></script>
        <script src="assets/plugins/flot/jquery.flot.pie.min.js"></script>
        <script src="assets/plugins/jquery-sparkline/jquery.sparkline.min.js"></script>
        <script src="assets/js/alpha.min.js"></script>
        <script src="assets/js/dashboard.js"></script>
        
		<?php
		
		conecta();
		$sql = "SELECT count(tblActionList.action_dateconclusion) As concluidas FROM tblActionList WHERE company_cod = " . $_SESSION['company_cod'];
		$result = mysql_query($sql) or die("erro ao selecionar");
		$row = mysql_fetch_assoc($result);
		if ($row['concluidas'] > 0) {
			$concluidas = $row['concluidas'];
		} else {$concluidas = 0;}
		
		$sql = "SELECT count(*) As noprazo FROM tblActionList WHERE action_dateconclusion IS NULL AND DATEDIFF(CURDATE(), tblActionList.action_datedeadline) <= 0 AND company_cod = " . $_SESSION['company_cod'];
		$result = mysql_query($sql) or die("erro ao selecionar");
		$row = mysql_fetch_assoc($result);
		if ($row['noprazo'] > 0) {
			$noprazo = $row['noprazo'];
		} else {$noprazo = 0;}
		
		$sql = "SELECT count(*) As atrasadas FROM tblActionList WHERE action_dateconclusion IS NULL AND DATEDIFF(CURDATE(), tblActionList.action_datedeadline) > 0 AND company_cod = " . $_SESSION['company_cod'];
		$result = mysql_query($sql) or die("erro ao selecionar");
		$row = mysql_fetch_assoc($result);
		if ($row['atrasadas'] > 0){
			$atrasadas = $row['atrasadas'];
		} else $atrasadas = 0;
		
		$sql = "SELECT count(*) As canceladas FROM tblActionList WHERE company_cod = " . $_SESSION['company_cod'] . " AND action_canceled = 1";
		$result = mysql_query($sql) or die("erro ao selecionar");
		$row = mysql_fetch_assoc($result);
		if ($row['canceladas'] > 0){
			$canceladas = $row['canceladas'];
		} else $canceladas = 0;
		
		
		
		$sql = "SELECT tblUsersLogin.user_name as user_name, count(tblActionList.action_cod) As atrasadas FROM tblActionList INNER JOIN tblUsersLogin ON tblActionList.userresp_cod = tblUsersLogin.user_cod WHERE tblActionList.action_dateconclusion IS NULL AND DATEDIFF(CURDATE(), tblActionList.action_datedeadline) > 0 AND tblActionList.company_cod = " . $_SESSION['company_cod'] . " GROUP BY tblUsersLogin.user_name ORDER BY count(tblActionList.action_cod) DESC LIMIT 10";
		$result = mysql_query($sql) or die("erro ao selecionar");
		$respatrasadas = "";
		$contatrasadas = "";
		if (mysql_num_rows($result) > 0) {
			while($row = mysql_fetch_array($result)) {
				$respatrasadas = $respatrasadas ."\"" . $row['user_name'] ."\", ";
				$contatrasadas = $contatrasadas . $row['atrasadas'] .", ";
			}
		}
		
		$sql = "SELECT tblUsersLogin.user_name as user_name, count(tblActionList.action_cod) As atrasadas FROM tblActionList INNER JOIN tblUsersLogin ON tblActionList.userresp_cod = tblUsersLogin.user_cod WHERE tblActionList.action_dateconclusion IS NULL AND DATEDIFF(CURDATE(), tblActionList.action_datedeadline) > 0 AND tblActionList.company_cod = " . $_SESSION['company_cod'] . " GROUP BY tblUsersLogin.user_name ORDER BY count(tblActionList.action_cod) DESC LIMIT 1";
		$result = mysql_query($sql) or die("erro ao selecionar");
		if (mysql_num_rows($result) > 0) {
			while($row = mysql_fetch_array($result)) {
				$maxatrasadas = $row['atrasadas'];
			}
		}
		
		?>
		
		<script>
			$(document).ready(function() {
			 var ctx1 = document.getElementById("chart1").getContext("2d");
				var data1 = [
					{value: <?php echo $concluidas; ?>, color:"RGB(0,176,80)", highlight: "RGB(15,191,95)", label: "Concluidas"},
					{value: <?php echo $noprazo; ?>, color: "RGB(255,192,0)", highlight: "RGB(255,207,15)", label: "No Prazo"},
					{value: <?php echo $atrasadas; ?>, color: "RGB(192,0,0)", highlight: "RGB(207,15,15)",label: "Atrasadas"},
					{value: <?php echo $canceladas; ?>, color: "RGB(191,191,191)", highlight: "RGB(206,206,206)",label: "Canceladas"}
				];
				var myPieChart = new Chart(ctx1).Pie(data1,{
					segmentShowStroke : true,
					segmentStrokeColor : "#fff",
					segmentStrokeWidth : 2,
					animationSteps : 100,
					animationEasing : "easeOutBounce",
					animateRotate : false,
					animateScale : false,
					responsive: true,
					tooltipCornerRadius: 2
				});
			});
			
			    var ctx2 = document.getElementById("chart2").getContext("2d");
				var data2 = {
					labels: [<?php echo $respatrasadas; ?>],
					datasets: [
						{
						label: "Ranking atrasos", fillColor: "RGB(192,0,0)", strokeColor: "transparent",
						highlightFill: "RGB(207,15,15)", highlightStroke: "#B3B3B3", data: [<?php echo $contatrasadas; ?>]
						},
					]
				};

				var chart2 = new Chart(ctx2).Bar(data2, {
					scaleBeginAtZero : true,
					scaleShowGridLines : true,
					scaleGridLineColor : "rgba(0,0,0,.05)",
					scaleGridLineWidth : 1,
					scaleShowHorizontalLines: true,
					scaleShowVerticalLines: false,
					barShowStroke : true,
					barStrokeWidth : 2,
					barDatasetSpacing : 1,
					responsive: true,
					scaleOverride: true,
					scaleSteps: 1,
					scaleStepWidth: <?php echo $maxatrasadas ?>,
					scaleStartValue: 0,
					barValueSpacing: 40,
					tooltipCornerRadius: 2
				});
			
			
		</script>

		
		
    </body>
</html>
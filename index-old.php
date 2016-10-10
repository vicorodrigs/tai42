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
	

	<?php include("security/autenticate.php"); ?>
	
	<title>TAI 42</title>
	
</head>
<body onload="draw();">

	<nav class="mainNav">
		<!-- <i id="menuIcon" class="material-icons md-light" onclick="menuView()">&#xE5D2;</i> -->
		
		<ul id="menuList">
			<li><a href="index.php">
				<i class="material-icons md-light md-14">&#xE88A;</i>
				Dashboard</a></li>
			<li><a href="actions.php">
				<i class="material-icons md-light md-14">&#xE918;</i>
				Actions</a></li>
			<li><a href="#">
				<i class="material-icons md-light md-14">&#xE7EF;</i>
				Hierarchy</a></li>
			<li><a href="#">
				<i class="material-icons md-light md-14">&#xE916;</i>
				Projects</a></li>
			<li><a href="#">
			<i class="material-icons md-light md-14">&#xE8B8;</i>
			Configurations</a></li>
			<li><a href="logout.php">
			<i class="material-icons md-light md-14">&#xE879;</i>
			Logout</a></li>
		</ul>
	</nav>
<br>
	<section class="maincontent">
	
		<div id="pieChart" class="charts"></div>
	
	</section>
	
	
	
	
	
	
	<script>
		new Morris.Donut({
	  // ID of the element in which to draw the chart.
	  element: 'pieChart',
	  // Chart data records -- each entry in this array corresponds to a point on
	  // the chart.
	  colors: ['RGB(0,176,80)', 'RGB(191,191,191)','RGB(192,0,0)','RGB(255,192,0)'],
	  data: [
		{ label: 'Concluido', value: 20 },
		{ label: 'Cancelado', value: 5 },
		{ label: 'Atrasado', value: 5 },
		{ label: 'Em andamento', value: 10 }
	  ],
	  labels: ['Value']
		});
	</script>
</body>
</html>
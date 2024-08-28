<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="<?php echo SITE."css/style.css" ?>">
</head>
<body>
	<nav class="navbar">
		<a href="/home" class="navbar-link"><?php echo "&#x1f198;" ?></a>|
		<a href="/EmergencyAlerts" class="navbar-link">Mensajes de Alerta</a>
	</nav>	
	<main class="main">		
		<div class="container">
			<?php
			include_once '../Views/'.$path.'.php';
			?>
		</div>
	</main>
	<footer class="footer">
		Agregar Footer
	</footer>
	<script src=""></script>
</body>
</html>
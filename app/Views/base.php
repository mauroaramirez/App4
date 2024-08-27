<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css">
</head>
<body>
	<nav class="navbar">
		<a href="/home"></a>|
		<a href="/menu">MENU 1</a>|
	</nav>	
	<main class="main">		
		<div class="container">
			<?php
			include_once '../Views/'.$path.'.php';
			?>
		</div>
	</main>
	<footer class="footer">
		TEST FOOTER
	</footer>
	<script src=""></script>
</body>
</html>
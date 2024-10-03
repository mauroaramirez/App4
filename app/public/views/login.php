<?php
session_start();
if (!isset($_SESSION['rol'])) :
?>
	<!DOCTYPE html>
	<html>

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="form.css">
		<title>login</title>
	</head>

	<body>
		<center>
			<h3>Ingreso al sistema</h3>
			<form action="../../controllers/scriptSession.php" method="post">
				<label for="dni">DNI</label>
				<input type="number" name="dni">
				<br><br>
				<label for="pass">PASS</label>
				<input type="password" name="pass">
				<br><br>
				<input type="submit" name="submit" value="Ingresar">
			</form>
			<hr>
			<a href="./formTitulares.php">Registrar</a>
		</center>
	</body>

	</html>
<?php else : ?>
	<h1>Ya estas logeado, no se puede acceder a Login.</h1>
	<a href="./index.php">Home</a>
	<br><br>
	<a href="./formTitulares.php">Formulario Titulares</a>
	<br><br>
	<a href="./logout.php" style="margin-right: 2px;">Salir</a>
<?php endif ?>
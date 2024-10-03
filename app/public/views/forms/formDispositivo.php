<?php
session_start();

if ($_SESSION['rol_id'] == 1) :
?>

	<!DOCTYPE html>
	<html>

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Registro de Dispositivos</title>
	</head>

	<body>
		<center>
			<h3>Resgistro de Dispositivo</h3>
			<form action="../../controllers/scriptDispositivos.php" method="post">
				<table>
					<tr>
						<td><label for="marca">Marca:</label></td>
						<td><input type="text" name="marca"></td>
					</tr>
					<tr>
						<td><label for="modelo">Modelo:</label></td>
						<td><input type="text" name="modelo"></td>
					</tr>
					<tr>
						<td><label for="imei">IMEI:</label></td>
						<td><input type="text" name="imei"></td>
					</tr>
					<tr>
						<td colspan="2" style="text-align: center;">
							<br><input type="submit" name="nuevamarca" value="Registrar">
						</td>
					</tr>
				</table>
			</form>
			<hr>
			<nav><?php include_once '../links/linkPantallas.php' ?></nav>
		</center>
	<?php else : ?>
		<center>
			<nav><?php include_once '../links/linkSinPermisos.php' ?></nav>
		</center>
	<?php endif ?>
	</body>

	</html>
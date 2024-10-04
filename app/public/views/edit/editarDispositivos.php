<?php
session_start();
require_once '../../models/Dispositivos.php';

use Clases\Dispositivos;

if ($_SESSION['rol_id'] == 1) :

	$dispositivos = new Dispositivos;

	$dispositivos = $dispositivos->selectOne($_GET['id']);
?>
	<!DOCTYPE html>
	<html>

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Editar Dispositivo</title>
	</head>

	<body>
		<center>
			<h3>Editar Dispositivo</h3>
			<form action="../../controllers/scriptDispositivos.php" method="post">
				<table>
				<tr>
						<td><label for="marca">Marca:</label></td>
						<td><input type="text" name="marca" value="<?php echo trim($dispositivos[2]['marca']) ?>"></td>
					</tr>
					<tr>
						<td><label for="modelo">Modelo:</label></td>
						<td><input type="text" name="modelo" value="<?php echo trim($dispositivos[2]['modelo']) ?>"></td>
					</tr>
					<tr>
						<td><label for="email">IMEI:</label></td>
						<td><input type="imei" name="imei" value="<?php echo $dispositivos[2]['imei'] ?>"></td>
					</tr>
					<tr>
						<td colspan="2" style="text-align: center;">
							<input type="hidden" name="id" value="<?php echo $_GET['id'] ?>">
							<br>
							<input type="submit" name="updateDispositivo" value="Editar">
						</td>
					</tr>
				</table>
				<br>
				<a href="../dataTables/dataTableDispositivos.php">Ir a Consulta de Dispositivos</a>
				<nav><?php include_once '../links/linkPantallas.php' ?></nav>
			</form>
		</center>
	<?php else : ?>
		<center>
			<nav><?php include_once '../links/linkSinPermisos.php' ?></nav>
			<br>
			<a href="../dataTables/dataTableDispositivos.php">Ir a Consulta de Dispositivos</a>
		</center>
	<?php endif ?>
	</body>

	</html>
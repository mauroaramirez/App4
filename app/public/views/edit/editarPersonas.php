<?php
session_start();
require_once '../../models/Personas.php';

use Clases\Personas;

if ($_SESSION['rol_id'] == 1) :

	$dispositivos = new Personas;

	$dispositivos = $dispositivos->selectOne($_GET['id']);
	$nombre_completo = explode(",", $dispositivos[2]['titular']);
?>
	<!DOCTYPE html>
	<html>

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Editar Personas</title>
	</head>

	<body>
		<center>
			<h3>Editar Personas</h3>
			<form action="../../controllers/scriptPersonas.php" method="post">
				<table>
					<tr>
						<td><label for="nombre">Nombre:</label></td>
						<td><input type="text" name="nombre" value="<?php echo trim($nombre_completo[0]) ?>"></td>
					</tr>
					<tr>
						<td><label for="apellido">Apellido:</label></td>
						<td><input type="text" name="apellido" value="<?php echo trim($nombre_completo[1]) ?>"></td>
					</tr>
					<tr>
						<td><label for="email">Email:</label></td>
						<td><input type="email" name="email" value="<?php echo $dispositivos[2]['email'] ?>"></td>
					</tr>
					<tr>
						<td><label for="dni">DNI:</label></td>
						<td><input type="number" name="dni" value="<?php echo $dispositivos[2]['dni'] ?>"></td>
					</tr>
					<tr>
						<td><label>Sexo:</label></td>
						<td>
							<?php if ($dispositivos[2]['sexo'] == "F") : ?>
								<label for="sex">M</label>
								<input type="radio" name="sex" value="M">
								<label for="sex">F</label>
								<input type="radio" name="sex" value="F" checked>
							<?php else : ?>
								<label for="sex">M</label>
								<input type="radio" name="sex" value="M" checked>
								<label for="sex">F</label>
								<input type="radio" name="sex" value="F">
							<?php endif ?>
						</td>
					</tr>
					<tr>
						<td><label for="direccion">Dirección:</label></td>
						<td><input type="text" name="direccion" value="<?php echo $dispositivos[2]['direccion'] ?>"></td>
					</tr>
					<tr>
						<td><label for="pais">País:</label></td>
						<td><input type="text" name="pais" value="<?php echo $dispositivos[2]['pais'] ?>"></td>
					</tr>
					<tr>
						<td colspan="2" style="text-align: center;">
							<input type="hidden" name="id" value="<?php echo $_GET['id'] ?>">
							<br>
							<input type="submit" name="updatePersonas" value="Editar">
						</td>
					</tr>
				</table>
				<br>
				<a href="../dataTables/dataTablePersonas.php">Ir a Consulta de Personas</a>
				<nav><?php include_once '../links/linkPantallas.php' ?></nav>
			</form>
		</center>
	<?php else : ?>
		<center>
			<nav><?php include_once 'linkSinPermisos.php' ?></nav>
			<br>
			<a href="../dataTables/dataTablePersonas.php">Ir a Consulta de Personas</a>
		</center>
	<?php endif ?>
	</body>

	</html>
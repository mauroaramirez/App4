<?php
session_start();
// Se puede ingresar al formulario de registro de personas solo si es usuario ROOT o es un registro de un nuevo usuario
if ($_SESSION['rol_id'] == 1 || $_SESSION['rol_id'] == null)  :
?>
	<!DOCTYPE html>
	<html>

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Registro Personas</title>
	</head>

	<body>
		<center>
			<h3>Registro Personas</h3>
			<form action="../../controllers/scriptPersonas.php" method="post">
				<table>
					<tr>
						<td><label for="nombre">Nombre:</label></td>
						<td><input type="text" name="nombre"></td>
					</tr>
					<tr>
						<td><label for="apellido">Apellido:</label></td>
						<td><input type="text" name="apellido"></td>
					</tr>
					<tr>
						<td><label for="email">Email:</label></td>
						<td><input type="email" name="email"></td>
					</tr>
					<tr>
						<td><label for="dni">DNI:</label></td>
						<td><input type="number" name="dni"></td>
					</tr>
					<tr>
						<td><label for="telefono">Teléfono:</label></td>
						<td><input type="number" name="telefono"></td>
					</tr>
					<tr>
						<td><label>Sexo:</label></td>
						<td>
							<label for="sex">M</label>
							<input type="radio" name="sex" value="M">
							<label for="sex">F</label>
							<input type="radio" name="sex" value="F">
						</td>
					</tr>
					<tr>
						<td><label for="direccion">Dirección:</label></td>
						<td><input type="text" name="direccion"></td>
					</tr>
					<tr>
						<td><label for="pais">País:</label></td>
						<td><input type="text" name="pais"></td>
					</tr>
					<tr>
						<td><label for="pass">Password:</label></td>
						<td><input type="password" name="pass"></td>
					</tr>
					<tr>
						<td colspan="2" style="text-align: center;">
							<br>
							<input type="submit" name="newTitular" value="Registrar">
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
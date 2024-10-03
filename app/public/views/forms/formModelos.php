<?php
session_start();

require_once '../models/Modelos.php';

use Clases\Modelos;

// rol_id =  1 es perfil root
if ($_SESSION['rol_id'] == 1) :
	$modelo = new Modelos;

	$selectPersonas = $modelo->selectMarcas();
?>
	<!DOCTYPE html>
	<html>

	<head>
		<link href="formStyle.css" rel="stylesheet">
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Formulario de Modeloss</title>
	</head>

	<body>
		<center>
			<h3>Formulario de Modelos</h3>
			<form action="scriptModelos.php" method="post">
				<table>
					<tr>
						<td><label for="marca">Marca:</label></td>
						<td>
							<select name="marca" id="marca" class="custom-select">
								<?php foreach ($selectPersonas[2] as $key => $value) : ?>
									<option value="<?php echo $value['id'] ?>"><?php echo $value['descripcion'] ?></option>
								<?php endforeach ?>
							</select>
						</td>
					</tr>
					<tr>
						<td><label for="modelo">Modelo:</label></td>
						<td><input type="text" name="modelo"></td>
					</tr>
					<td colspan="2" style="text-align: center;padding: 5px;">
						<input type="submit" name="newmodelo" value="Registrar">
					</td>
					</tr>
				</table>
				<nav><?php include_once 'linkPantallas.php' ?></nav>
			</form>
		</center>
	<?php else : ?>
		<center>
			<nav><?php include_once 'linkSinPermisos.php' ?></nav>
		</center>
	<?php endif ?>
	</body>

	</html>
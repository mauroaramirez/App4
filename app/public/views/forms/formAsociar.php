<?php
session_start();

require_once '../../models/Asociar.php';
require_once '../../models/Personas.php';
require_once '../../models/Dispositivos.php';

use Clases\Personas;
use Clases\Dispositivos;



// rol_id = 1 es perfil root
if ($_SESSION['rol_id'] == 1) :

	$dispositivos = new Dispositivos;
	$personas = new Personas;

	$selectPersonas = $personas->selectPersonas();
	$selectDispositivos = $dispositivos->selectDispositivos();

?>
	<!DOCTYPE html>
	<html>

	<head>
		<link href="formStyle.css" rel="stylesheet">
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Vincular dispositivos</title>
	</head>

	<body>
		<center>
			<h3>Vincular dispositivos</h3>
			<form action="../../controllers/scriptVincular.php" method="post">
				<table>
					<tr>
						<td><label for="persona">Personas:</label></td>
						<td>
							<select name="persona" id="persona" class="custom-select">
								<?php foreach ($selectPersonas[2] as $key => $value) : ?>
									<option value="<?php echo $value['id'] ?>"><?php echo $value['personas'] ?></option>
								<?php endforeach ?>
							</select>
						</td>
					</tr>

					<tr>
						<td><label for="dispositivo">Dispositivo:</label></td>
						<td>
							<select name="dispositivo" id="dispositivo" class="custom-select">
								<?php foreach ($selectDispositivos[2] as $key => $value) : ?>
									<option value="<?php echo $value['id'] ?>"><?php echo $value['imei'] ?></option>
								<?php endforeach ?>
							</select>
						</td>
					</tr>

					<td colspan="2" style="text-align: center;padding: 5px;">
						<br>
						<input type="submit" name="vincular" value="Vincular">
					</td>
					</tr>
				</table>
				<nav><?php include_once '../links/linkPantallas.php' ?></nav>
			</form>
		</center>
	<?php else : ?>
		<center>
			<nav><?php include_once '../links/linkSinPermisos.php' ?></nav>
		</center>
	<?php endif ?>
	</body>

	</html>
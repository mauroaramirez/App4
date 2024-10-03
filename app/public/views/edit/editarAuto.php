<?php
session_start();
require_once './Clases/Autos.php';
require_once './Clases/Titulares.php';
require_once './Clases/Modelos.php';

use Clases\Asociar;
use Clases\Modelos;
use Clases\Personas;

if ($_SESSION['rol_id'] == 1) :

	$asociar = new Asociar;
	$modelo = new Modelos;
	$personas = new Personas;

	$selectPersonas = $modelo->selectMarcas();
	$selectDispositivos = $modelo->selectModelos();
	$selectTitulares = $personas->selectPersonas();
	$selectTipoVehiculos = $asociar->selectTipoVehiculos();
	$selectTipoCarroceria = $asociar->selectTipoCarroceria();
	$selectTipoTransmision = $asociar->selectTipoTransmision();
	$selectTipoMotor = $asociar->selectTipoMotor();

	$asociar = $asociar->selectOne($_GET['id']);
	$nombre_completo = explode(",", $asociar[2]['titular']);

?>
	<!DOCTYPE html>
	<html>

	<head>
		<link href="formStyle.css" rel="stylesheet">
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Editar Auto</title>
	</head>

	<body>
		<center>
			<h2>Editar Auto N°: <?php echo $asociar[2]['id'] ?></h2>
			<form action="scriptAutos.php" method="post">
				<table>
					<tr>
						<td><label for="marca">Marca:</label></td>
						<td>
							<select name="marca" id="marca" class="custom-select">
								<?php foreach ($selectPersonas[2] as $key => $value) : ?>
									<!-- Logica para mostra el valor por defecto en el select -->
									<!-- Comparo el valor del select a la tabla con el valor almacenado -->
									<option value="<?php echo $value['id'] ?>" <?php $valorPorDefecto = $asociar[2]['marca']; ?> <?php if ($value['descripcion'] == $valorPorDefecto) : ?> selected <?php endif; ?>>
										<?php echo $value['descripcion'] ?>
									</option>
								<?php endforeach ?>
							</select>
						</td>
					</tr>
					<tr>
						<td><label for="modelo">Modelo:</label></td>
						<td>
							<select name="modelo" id="modelo" class="custom-select">
								<?php foreach ($selectDispositivos[2] as $key => $value) : ?>
									<option value="<?php echo $value['id'] ?>" <?php $valorPorDefecto = $asociar[2]['modelo']; ?> <?php if ($value['descripcion'] == $valorPorDefecto) : ?> selected <?php endif; ?>>
										<?php echo $value['descripcion'] ?>
									</option>
								<?php endforeach ?>
							</select>
						</td>
					</tr>
					<tr>
						<td><label for="titular">Titular:</label></td>
						<td>
							<select name="titular" id="titular" class="custom-select">
								<?php foreach ($selectTitulares[2] as $key => $value) : ?>
									<option value="<?php echo $value['id'] ?>" <?php $valorPorDefecto = $asociar[2]['titular']; ?> <?php if ($value['titulares'] == $valorPorDefecto) : ?> selected <?php endif; ?>>
										<?php echo $value['titulares'] ?>
									</option>
								<?php endforeach ?>
							</select>
						</td>
					</tr>
					<tr>
						<td><label for="tipoVehiculo">Tipo Vehiculo:</label></td>
						<td>
							<select name="tipoVehiculo" id="tipoVehiculo" class="custom-select">
								<?php foreach ($selectTipoVehiculos[2] as $key => $value) : ?>
									<option value="<?php echo $value['id'] ?>" <?php $valorPorDefecto = $asociar[2]['tipo_vehiculo']; ?> <?php if ($value['descripcion'] == $valorPorDefecto) : ?> selected <?php endif; ?>>
										<?php echo $value['descripcion'] ?>
									</option>
								<?php endforeach ?>
							</select>
						</td>
					</tr>
					<tr>
						<td><label for="tipoCarroceria">Tipo Carroceria:</label></td>
						<td>
							<select name="tipoCarroceria" id="tipoCarroceria" class="custom-select">
								<?php foreach ($selectTipoCarroceria[2] as $key => $value) : ?>
									<option value="<?php echo $value['id'] ?>" <?php $valorPorDefecto = $asociar[2]['tipo_carroceria']; ?> <?php if ($value['descripcion'] == $valorPorDefecto) : ?> selected <?php endif; ?>>
										<?php echo $value['descripcion'] ?>
									</option>
								<?php endforeach ?>
							</select>
						</td>
					</tr>
					<tr>
						<td><label for="tipoTransmision">Tipo Transmision:</label></td>
						<td>
							<select name="tipoTransmision" id="tipoTransmision" class="custom-select">
								<?php foreach ($selectTipoTransmision[2] as $key => $value) : ?>
									<option value="<?php echo $value['id'] ?>" <?php $valorPorDefecto = $asociar[2]['tipo_transmicion']; ?> <?php if ($value['descripcion'] == $valorPorDefecto) : ?> selected <?php endif; ?>>
										<?php echo $value['descripcion'] ?>
									</option>
								<?php endforeach ?>
							</select>
						</td>
					</tr>
					<tr>
						<td><label for="tipoMotor">Tipo Motor:</label></td>
						<td>
							<select name="tipoMotor" id="tipoMotor" class="custom-select">
								<?php foreach ($selectTipoMotor[2] as $key => $value) : ?>
									<option value="<?php echo $value['id'] ?>" <?php $valorPorDefecto = $asociar[2]['tipo_motor']; ?> <?php if ($value['descripcion'] == $valorPorDefecto) : ?> selected <?php endif; ?>>
										<?php echo $value['descripcion'] ?>
									</option>
								<?php endforeach ?>
							</select>
						</td>
					</tr>
					<tr>
						<td><label for="peso">Peso:</label></td>
						<td><input type="text" name="peso" value="<?php echo $asociar[2]['peso'] ?>"></td>
					</tr>

					<tr>
						<td><label for="rodado">Rodado:</label></td>
						<td><input type="text" name="rodado" value="<?php echo $asociar[2]['rodado'] ?>"></td>
					</tr>

					<tr>
						<td><label for="color">Color:</label></td>
						<td><input type="text" name="color" value="<?php echo $asociar[2]['color'] ?>"></td>
					</tr>
					<tr>
						<td colspan="2" style="text-align: center;">
							<input type="hidden" name="id" value="<?php echo $_GET['id'] ?>">
							<br>
							<input type="submit" name="updateAuto" value="Editar">
						</td>
					</tr>
				</table>
				<br>
				<a href="./dataTableAutos.php">Ir a Consulta de Autos</a>
				<nav><?php include_once 'linkPantallas.php' ?></nav>
			</form>
		</center>
	<?php else : ?>
		<center>
			<nav><?php include_once 'linkSinPermisos.php' ?></nav>
			<br>
			<a href="./dataTableAutos.php">Ir a Consulta de Autos</a>
		</center>
	<?php endif ?>
	</body>

	</html>
<?php
session_start();
require_once './Clases/Autos.php';

use Clases\Asociar;

$autos = new Asociar;

$dataTable = $autos->selectAll();
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Consulta de Autos</title>
</head>

<body>
	<center>
		<h3>Consulta de Autos</h3>
		<table border="1">
			<thead>
				<tr>
					<th>N° Auto</th>
					<th>Marca</th>
					<th>Modelo</th>
					<th>Titular</th>
					<th>Tipo Vehiculo</th>
					<th>Tipo Carroceria</th>
					<th>Tipo Transmision</th>
					<th>Tipo Motor</th>
					<th>Peso</th>
					<th>Rodado</th>
					<th>Color</th>
					<th>Acciones</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($dataTable[2] as $key => $value) : ?>
					<tr>
						<td><?php echo $value['id'] ?></td>
						<td><?php echo $value['marca'] ?></td>
						<td><?php echo $value['modelo'] ?></td>
						<td><?php echo $value['titular'] ?></td>
						<td><?php echo $value['tipo_vehiculo'] ?></td>
						<td><?php echo $value['tipo_carroceria'] ?></td>
						<td><?php echo $value['tipo_transmicion'] ?></td>
						<td><?php echo $value['tipo_motor'] ?></td>
						<td><?php echo $value['peso'] ?></td>
						<td><?php echo $value['rodado'] ?></td>
						<td><?php echo $value['color'] ?></td>
						<td>
							<a href="verAutos.php?id=<?php echo $value['id'] ?>">Ver</a>
							<a href="editarAuto.php?id=<?php echo $value['id'] ?>">Editar</a>
							<a href="borrarAuto.php?id=<?php echo $value['id'] ?>">Borrar</a>
						</td>
					</tr>
				<?php endforeach ?>
			</tbody>
		</table>
		<br>
		<nav><?php include_once 'linkPantallas.php' ?></nav>
	</center>
</body>

</html>
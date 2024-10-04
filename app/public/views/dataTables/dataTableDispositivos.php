<?php
session_start();
require_once '../../models/Dispositivos.php';

use Clases\Dispositivos;

$dispositivos = new Dispositivos;

$dataTable = $dispositivos->selectDispositivos();

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Consulta de Dispositivos</title>
</head>

<body>
	<center>
		<h3>Consulta de Dispositivos</h3>
		<table border="1">
			<thead>
				<tr>
					<th>ID</th>
					<th>Marca</th>
					<th>Modelo</th>
					<th>IMEI</th>
					<th>Acciones</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($dataTable[2] as $key => $value) : ?>
					<tr>
						<td><?php echo $value['id'] ?></td>
						<td><?php echo $value['marca'] ?></td>
						<td><?php echo $value['modelo'] ?></td>
						<td><?php echo $value['imei'] ?></td>
						<td>
							<a href="../get/verDispositivos.php?id=<?php echo $value['id'] ?>">Ver</a>
							<a href="../edit/editarDispositivos.php?id=<?php echo $value['id'] ?>">Editar</a>
							<a href="../delete/deleteDispositivos.php?id=<?php echo $value['id'] ?>">Borrar</a>
						</td>
					</tr>
				<?php endforeach ?>
			</tbody>
		</table>
		<nav><?php include_once '../links/linkPantallas.php' ?></nav>
	</center>
</body>

</html>
<?php
session_start();
require_once '../../models/Personas.php';

use Clases\Personas;

$dispositivos = new Personas;

$dataTable = $dispositivos->selectAll();
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Consulta de Personas</title>
</head>

<body>
	<center>
		<h3>Consulta de Personas</h3>
		<table border="1">
			<thead>
				<tr>
					<th>Titular</th>
					<th>DNI</th>
					<th>Sexo</th>
					<th>Email</th>
					<th>Direccion</th>
					<th>Pais</th>
					<th>Acciones</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($dataTable[2] as $key => $value) : ?>
					<tr>
						<td><?php echo $value['personas'] ?></td>
						<td><?php echo $value['dni'] ?></td>
						<td><?php echo $value['sexo'] ?></td>
						<td><?php echo $value['email'] ?></td>
						<td><?php echo $value['direccion'] ?></td>
						<td><?php echo $value['pais'] ?></td>
						<td>
							<a href="../get/verPersonas.php?id=<?php echo $value['id'] ?>">Ver</a>
							<a href="../edit/editarPersonas.php?id=<?php echo $value['id'] ?>">Editar</a>
							<a href="../delete/deletePersonas.php?id=<?php echo $value['id'] ?>">Borrar</a>
						</td>
					</tr>
				<?php endforeach ?>
			</tbody>
		</table>
		<nav><?php include_once '../links/linkPantallas.php' ?></nav>
	</center>
</body>

</html>
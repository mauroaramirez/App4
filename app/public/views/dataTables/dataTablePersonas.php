<?php
session_start();
require_once '../../models/Personas.php';

use Clases\Personas;

$dispositivos = new Personas;

$dataTable = $dispositivos->selectAll();
?>
<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Consulta de Personas</title>
	<!-- Vincular Bootstrap y el archivo CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="../../css/style.css">
</head>

<body class="form-background">
	<div class="container mt-1">
		<div class="row justify-content-center">
			<div class="col-md-10">
				<div class="card p-4">
					<h3 class="text-center">Consulta de Personas</h3>
					<table class="table table-bordered mt-3">
						<thead>
							<tr>
								<th>Titular</th>
								<th>DNI</th>
								<th>Sexo</th>
								<th>Email</th>
								<th>Dirección</th>
								<th>País</th>
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
										<a href="../get/verPersonas.php?id=<?php echo $value['id'] ?>" class="btn btn-info btn-sm">Ver</a>
										<a href="../edit/editarPersonas.php?id=<?php echo $value['id'] ?>" class="btn btn-warning btn-sm">Editar</a>
										<a href="../delete/deletePersonas.php?id=<?php echo $value['id'] ?>" class="btn btn-danger btn-sm">Borrar</a>
									</td>
								</tr>
							<?php endforeach ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>

	<!-- Vincular Bootstrap JS -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

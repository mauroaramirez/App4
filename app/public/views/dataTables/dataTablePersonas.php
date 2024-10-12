<?php
session_start();
require_once '../../models/Personas.php';

use Clases\Personas;

$personas = new Personas;

$dataTable = $personas->selectAll();

?>
<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Consulta de Personas</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
	<link rel="stylesheet" href="../../css/style.css">
</head>

<script>
	$(document).ready(function() {
		$('table').DataTable({
			"pageLength": 5,
			"lengthMenu": [5, 10],
			"autoWidth": true,
			"scrollX": true,
			"fixedHeader": true
		});
	});
</script>

<style>
	table th,
	table td {
		text-align: center;
	}

	table td:last-child {
		white-space: nowrap;
	}
</style>

<body class="form-background">
	<div class="container-fluid mt-5">
		<div class="row mb-4 justify-content-center">
			<div class="col-12 col-md-4 col-lg-7">
				<div class="card p-5 text-left">
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
									<td><?php echo $value['people'] ?></td>
									<td><?php echo $value['dni'] ?></td>
									<td><?php echo $value['gender'] ?></td>
									<td><?php echo $value['email'] ?></td>
									<td><?php echo $value['addresses'] ?></td>
									<td><?php echo $value['country'] ?></td>
									<td>
										<a href="../get/verPersonas.php?id=<?php echo $value['id'] ?>" class="btn btn-info btn-sm">Ver</a>
										<a href="../edit/editarPersonas.php?id=<?php echo $value['id'] ?>" class="btn btn-warning btn-sm">Editar</a>
										<a href="../delete/deletePersonas.php?id=<?php echo $value['id'] ?>" class="btn btn-danger btn-sm">Borrar</a>
									</td>
								</tr>
							<?php endforeach ?>
						</tbody>
					</table>
					<?php include_once '../links/linkPantallas.php' ?>
				</div>
			</div>
		</div>
	</div>
	<?php include_once '../../views/footer/footer.php' ?>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
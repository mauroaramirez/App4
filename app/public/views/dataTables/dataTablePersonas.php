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
			"fixedHeader": true,
			"language": {
                "search": "Buscar:", // Personaliza el texto del campo de búsqueda
                "lengthMenu": "Mostrar _MENU_ registros por página",
                "info": "Mostrando página _PAGE_ de _PAGES_",
                "paginate": {
                    "previous": "Anterior",
                    "next": "Siguiente"
                }
            }
		});
	});
</script>

<style>
    .table th, 
    .table td {
        text-align: center;
        vertical-align: middle;
    }

    .table th {
        text-align: center !important;
    }

	table td:last-child {
		white-space: nowrap;
	}

	.dataTables_filter {
		margin-bottom: 20px;
	}

	table.dataTable {
		border-top: 1px solid #dee2e6;
		margin-top: 10px;
	}

	    /* Centrar específicamente los encabezados */
		.table th {
        text-align: center !important; /* Usar !important para forzar el centrado */
    }

	/* Ajustes específicos para pantallas pequeñas */
	@media (max-width: 768px) {
		.card {
			padding: 10px;
		}
		h3 {
			font-size: 1.4rem;
		}
		.table-responsive {
			overflow-x: auto;
		}
		.table td,
		.table th {
			font-size: 0.85rem;
			padding: 8px;
		}
	}
</style>

<body class="form-background">
	<div class="container-fluid mt-5">
		<div class="row mb-4 justify-content-center">
			<div class="col-12 col-md-8 col-lg-6">
				<div class="card p-4">
					<h3 class="text-center">Listado de Personas</h3>
					<!-- Ajuste de la tabla para pantallas pequeñas -->
					<div class="table-responsive">
						<table class="table table-bordered mt-3">
							<thead>
								<tr>
									<th>Titular</th>
									<th>DNI</th>
									<th>Género</th>
									<th>Email</th>
									<th>Dirección</th>
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
					<?php include_once '../links/linkPantallas.php' ?>
				</div>
			</div>
		</div>
	</div>
	<?php include_once '../../views/footer/footer.php' ?>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

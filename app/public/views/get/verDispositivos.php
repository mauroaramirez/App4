<?php
//session_start();
require_once '../../models/Dispositivos.php';

use Clases\Dispositivos;

$dispositivos = new Dispositivos;

$dispositivos = $dispositivos->selectOneDispositivo($_GET['id']);

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Ver Dispositivo</title>
	<!-- Bootstrap CSS -->
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
	<!-- Custom CSS -->
	<link rel="stylesheet" href="../../css/style.css">
	<style>
		/* Ajustar el ancho de la tarjeta */
		.card-custom {
			max-width: 600px;
			margin: 0 auto;
		}

		/* Reducir el espaciado entre párrafos */
		.card-body p {
			margin-bottom: 10px;
		}
	</style>
</head>

<body class="form-background">
	<div class="container">
		<div class="card card-custom">
			<h3 class="text-center">Datos del Dispositivo</h3>
			<div class="card-body text-center">
				<p><strong>ID: </strong><?php echo $dispositivos[2]['id'] ?></p>
				<p><strong>Marca: </strong><?php echo $dispositivos[2]['marca'] ?></p>
				<p><strong>Modelo: </strong><?php echo $dispositivos[2]['modelo'] ?></p>
				<p><strong>IMEI: </strong><?php echo $dispositivos[2]['imei'] ?></p>
				<a href="../../views/dataTables/dataTableDispositivos.php" class="btn btn-link">Ir a Consulta de Dispositivos</a>
			</div>
		</div>
	</div>

	<!-- Bootstrap JS -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
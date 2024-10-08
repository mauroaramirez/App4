<?php
session_start();

if ($_SESSION['rol_id'] == 1) :
?>
	<!DOCTYPE html>
	<html lang="es">

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Registro de Dispositivos</title>
		<!-- Vincular Bootstrap y el archivo CSS -->
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
		<link rel="stylesheet" href="../../css/style.css">
	</head>

	<body class="form-background">
		<div class="container mt-5"> <!-- Ajustamos el margen superior -->
			<div class="row justify-content-center">
				<div class="col-md-5">
					<div class="card p-4">
						<h3 class="text-center">Registro de Dispositivos</h3>
						<form action="../../controllers/scriptDispositivos.php" method="post">
							<div class="mb-4">
								<label for="marca" class="form-label">Marca:</label>
								<input type="text" name="marca" class="form-control" required placeholder="Escriba la Marca">
							</div>
							<div class="mb-4">
								<label for="modelo" class="form-label">Modelo:</label>
								<input type="text" name="modelo" class="form-control" required placeholder="Escriba el Modelo">
							</div>
							<div class="mb-4">
								<label for="imei" class="form-label">IMEI:</label>
								<input type="text" name="imei" class="form-control" required placeholder="Escriba el N° IMEI">
							</div>
							<div class="text-center">
								<input type="submit" name="newDispositivo" value="Registrar" class="btn btn-primary">
							</div>
						</form>
						<?php include_once '../links/linkPantallas.php'?>
					</div>
				</div>
			</div>
		</div>

		<!-- Vincular Bootstrap JS -->
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
	</body>

	</html>
<?php else : ?>
	<!DOCTYPE html>
	<html lang="es">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Sin permisos</title>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
		<link rel="stylesheet" href="../style.css">
	</head>
	<body class="form-background">
		<div class="container mt-5 text-center">
			<div class="card p-4">
				<?php include_once '../links/linkSinPermisos.php'; ?>
			</div>
		</div>
	</body>
	</html>
<?php endif ?>

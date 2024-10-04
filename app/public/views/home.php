<?php
session_start();
if (isset($_SESSION['id'])) {
?>
	<!DOCTYPE html>
	<html lang="es">

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Geolocalización</title>
		<!-- Vincular Bootstrap y el archivo CSS -->
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
		<link rel="stylesheet" href="../css/style.css">
	</head>

	<!-- Agregamos la clase 'home-background' -->

	<body class="home-background">
		<div class="container mt-5">
			<!-- Fila con información del usuario y botón de cerrar sesión -->
			<div class="row mb-4">
				<div class="col-12">
					<div class="card p-4">
						<div class="row align-items-center">
							<div class="col-md-8">
								<p class="mb-0">
									<b>Usuario:</b> <?php echo $_SESSION['personas'] ?><br>
									<b>Rol:</b> <?php echo $_SESSION['rol'] ?><br>
									<b>Email:</b> <?php echo $_SESSION['email'] ?>
								</p>
							</div>
							<div class="col-md-4 text-end">
								<a href="./logout.php" class="btn btn-danger">Cerrar sesión</a>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="card p-4">
				<h3 class="mb-4">Opciones del sistema</h3>

				<div class="list-group">
					<a href="./forms/formPersonas.php" class="list-group-item list-group-item-action">Registrar Personas</a>
					<a href="./forms/formDispositivo.php" class="list-group-item list-group-item-action">Registrar Dispositivos</a>
					<a href="./dataTables/dataTablePersonas.php" class="list-group-item list-group-item-action">Consulta Personas</a>
					<a href="./dataTables/dataTableDispositivos.php" class="list-group-item list-group-item-action">Consulta Dispositivos</a>
					<a href="./forms/formVincular.php" class="list-group-item list-group-item-action">Asociar Dispositivos</a>
					<a href="./dataTables/dataTableVinculados.php" class="list-group-item list-group-item-action">Consulta Dispositivos Vinculados</a>
					<a href="./mapa.html" class="list-group-item list-group-item-action">Ver Mapa</a>
				</div>
			</div>
		</div>

		<!-- Vincular Bootstrap JS -->
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
	</body>

	</html>
<?php
} else {
	echo "No estás logeado";
	echo '<br><a href="./login.php">Log in</a>';
}
?>
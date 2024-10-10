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
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
		<link rel="stylesheet" href="../css/style.css">
	</head>

	<style>
		.list-group-item:hover {
			background-color: #cce5ff;
			/* color celeste */
		}

		/* Estilos para el footer */
		footer {
			color: white;
			position: absolute;
			bottom: 0;
			margin-bottom: 0;
			width: 100%;
			/*background-image: url('../img/image.png');*/
			background: linear-gradient(270deg, #3B4142, #1C474E, black);
			background-size: 600% 600%;
            animation: gradientAnimation 20s ease infinite;

			background-position: center;
			background-repeat: no-repeat;
			min-height: 15vh;
			text-align: center;
			padding: 10px 0;
		}

		@keyframes gradientAnimation {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

		footer img {
			height: 50px;
			/* Ajustar el tamaño del logo */
		}
	</style>

	<body class="home-background">
		<div class="container mt-5">
			<div class="row mb-4 justify-content-center">
				<div class="col-12 col-md-6">
					<div class="card p-4 text-left">
						<div class="row align-items-center">
							<div class="col-md-8">
								<p class="mb-0 fs-6">
									<b>Usuario:</b> <?php echo $_SESSION['personas'] ?><br>
									<b>Rol:</b> <?php echo $_SESSION['rol'] ?><br>
									<b>Email:</b> <?php echo $_SESSION['email'] ?>
								</p>
							</div>
							<div class="col-md-4 text-end">
								<a href="./logout.php" class="btn btn-danger btn-md">Cerrar sesión</a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-12 col-md-6">
					<div class="card p-4">
						<h3 class="mb-4 text-center">Opciones del sistema</h3>
						<div class="list-group text-center">
							<a href="./forms/formPersonas.php" class="list-group-item list-group-item-action fs-6">Registrar Personas</a>
							<a href="./forms/formDispositivo.php" class="list-group-item list-group-item-action fs-6">Registrar Dispositivos</a>
							<a href="./dataTables/dataTablePersonas.php" class="list-group-item list-group-item-action fs-6">Consulta Personas</a>
							<a href="./dataTables/dataTableDispositivos.php" class="list-group-item list-group-item-action fs-6">Consulta Dispositivos</a>
							<a href="./forms/formVincular.php" class="list-group-item list-group-item-action fs-6">Asociar Dispositivos</a>
							<a href="./dataTables/dataTableVinculados.php" class="list-group-item list-group-item-action fs-6">Consulta Dispositivos Vinculados</a>
							<a href="./get/verIMEI.php" class="list-group-item list-group-item-action fs-6">Ver Ubicación por IMEI</a>
						</div>
					</div>
				</div>
			</div>
		</div>

		<footer>
			<h5>&copy; 2024 - Geolocalización - Practicas Profesionalizantes II</h5>
			<a href="../views/home.php">
				<img src="../img/logo.png" alt="Logo de la empresa">
			</a>
		</footer>

		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
	</body>

	</html>
<?php
} else {
	echo "No estás logeado";
	echo '<br><a href="./login.php">Log in</a>';
}
?>

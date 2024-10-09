<?php
session_start();
if (!isset($_SESSION['rol'])) :
?>
	<!DOCTYPE html>
	<html lang="es">

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
		<link rel="stylesheet" href="../css/style.css">
		<title>Login</title>
	</head>
	
	<video autoplay muted loop id="bg-video">
  		<source src="../video/video-1.mp4"video/mp4">
	</video>
	<!-- Prueba video de fondo -->
	<style>
	#bg-video {
		position: fixed;
		right: 0;
		bottom: 0;
		min-width: 100%;
		min-height: 100%;
		z-index: -1;
	}

	body {
		margin: 0;
		padding: 0;
		height: 100%;
		display: flex;
		justify-content: center;
		align-items: center;
		font-family: Arial, sans-serif;
	}
	</style>

	<body>
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-5">
					<div class="card p-5">
						<h3 class="text-center mb-4">Ingreso al sistema</h3>
						<form action="../../controllers/scriptSession.php" method="post">
							<div class="mb-3">
								<label for="dni" class="form-label">DNI:</label>
								<input type="text" name="dni" id="dni" class="form-control" required>
							</div>
							<div class="mb-3">
								<label for="pass" class="form-label">PASS:</label>
								<input type="password" name="pass" id="pass" class="form-control" required>
							</div>
							<div class="d-grid">
								<br><br><button type="submit" name="submit" class="btn btn-primary">Ingresar</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>

		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
	</body>

	</html>
<?php else : ?>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="../css/style.css">
	<div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card p-4">
					<h1>Ya estás logeado, no se puede acceder al Login.</h1>
					<a href="../views/home.php" class="btn btn-info mt-3">Home</a>
					<a href="./logout.php" class="btn btn-danger mt-3">Cerrar Sesión</a>
				</div>
			</div>	
        </div>
    </div>
<?php endif ?>

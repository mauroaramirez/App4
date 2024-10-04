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
		<link rel="stylesheet" href="../css/style.css"> <!-- Enlace al archivo de estilos -->
		<title>Login</title>
	</head>

	<body>
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-4">
					<div class="card">
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
								<button type="submit" name="submit" class="btn btn-primary">Ingresar</button>
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
	<div class="container text-center mt-5">
		<h1>Ya estás logeado, no se puede acceder al Login.</h1>
		<a href="./index.php" class="btn btn-secondary mt-3">Home</a>
		<a href="./formTitulares.php" class="btn btn-secondary mt-3">Formulario Titulares</a>
		<a href="./logout.php" class="btn btn-danger mt-3">Salir</a>
	</div>
<?php endif ?>

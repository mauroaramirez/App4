<?php
session_start();

if ($_SESSION['rol_id'] == 1 || $_SESSION['rol_id'] == 2 ||$_SESSION['rol_id'] == null) :
?>
	<!DOCTYPE html>
	<html lang="es">

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Registro Personas</title>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
		<link rel="stylesheet" href="../../css/style.css">
	</head>

	<body class="form-background">
		<div class="container-fluid mt-5">
			<div class="row mb-4 justify-content-center">
				<div class="col-12 col-md-6 col-lg-4">
					<div class="card p-4 text-left">
						<h3 class="text-center">Registrar Persona</h3>
						<form action="../../controllers/scriptPersonas.php" method="post">
							<div class="mb-3">
								<label for="nombre" class="form-label">Nombre: </label>
								<input type="text" name="nombre" class="form-control" required placeholder="Ingresar nombre">
							</div>
							<div class="mb-3">
								<label for="apellido" class="form-label">Apellido:</label>
								<input type="text" name="apellido" class="form-control" required placeholder="Ingresar apellido">
							</div>
							<div class="mb-3">
								<label for="email" class="form-label">Correo electrónico:</label>
								<input type="email" name="email" class="form-control" required placeholder="Ingresar Correo electrónico">
							</div>
							<div class="mb-3">
								<label for="dni" class="form-label">Número de DNI:</label>
								<input type="number" name="dni" class="form-control" required placeholder="Ingresar número de DNI">
							</div>
							<div class="mb-3">
								<label for="telefono" class="form-label">Teléfono:</label>
								<input type="number" name="telefono" class="form-control" required placeholder="Ingresar Teléfono">
							</div>
							<div class="mb-3">
								<label>Género:</label>
								<div>
									<label for="sex" class="form-check-label">Masculino</label>
									<input type="radio" name="sex" value="M" class="form-check-input" required style="margin-right: 20px;">
									<label for="sex" class="form-check-label">Femenino</label>
									<input type="radio" name="sex" value="F" class="form-check-input" required style="margin-right: 20px;">
									<label for="sex" class="form-check-label">X</label>
									<input type="radio" name="sex" value="X" class="form-check-input" required>
								</div>
							</div>
							<div class="mb-3">
								<label for="direccion" class="form-label">Dirección:</label>
								<input type="text" name="direccion" class="form-control" required placeholder="Ingresar dirección">
							</div>
							<div class="mb-3">
								<label for="pais" class="form-label">País:</label>
								<input type="text" name="pais" class="form-control" required placeholder="Ingresar País">
							</div>
							<div class="mb-3">
								<label for="pass" class="form-label">Contraseña:</label>
								<input type="password" name="pass" class="form-control" required placeholder="Ingresar Contraseña">
							</div>
							<div class="text-center">
								<input type="submit" name="insertPersona" value="Registrar" class="btn btn-primary">
							</div>
						</form>
						<?php include_once '../links/linkPantallas.php' ?>
					</div>
				</div>
			</div>
		</div>
		<?php include_once '../../views/footer/footer.php' ?>
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
<?php
session_start();
require_once '../../models/Personas.php';

use Clases\Personas;

if ($_SESSION['rol_id'] == 1) :

	$personas = new Personas;

	$personas = $personas->selectOne($_GET['id']);
	$nombre_completo = explode(",", $personas[2]['titular']);
?>
	<!DOCTYPE html>
	<html lang="es">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Editar Personas</title>
		<!-- Vincular Bootstrap y el archivo CSS -->
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
		<link rel="stylesheet" href="../../css/style.css">
	</head>

	<body class="form-background"> <!-- Aplicamos la clase para el fondo -->
		<div class="container mt-5">
			<div class="row justify-content-center">
				<div class="col-md-5">
					<div class="card p-3">
						<h3 class="text-center">Editar Personas</h3>
						<form action="../../controllers/scriptPersonas.php" method="post">
							<div class="mb-3">
								<label for="nombre" class="form-label">Nombre:</label>
								<input type="text" name="nombre" class="form-control" value="<?php echo trim($nombre_completo[0]) ?>" required>
							</div>
							<div class="mb-3">
								<label for="apellido" class="form-label">Apellido:</label>
								<input type="text" name="apellido" class="form-control" value="<?php echo trim($nombre_completo[1]) ?>" required>
							</div>
							<div class="mb-3">
								<label for="email" class="form-label">Email:</label>
								<input type="email" name="email" class="form-control" value="<?php echo $personas[2]['email'] ?>" required>
							</div>
							<div class="mb-3">
								<label for="dni" class="form-label">DNI:</label>
								<input type="number" name="dni" class="form-control" value="<?php echo $personas[2]['dni'] ?>" required>
							</div>
							<div class="mb-3">
								<label>Sexo:</label>
								<div>
									<label for="sex" class="form-check-label">M</label>
									<input type="radio" name="sex" value="M" class="form-check-input" <?php echo ($personas[2]['gender'] == "M") ? "checked" : ""; ?>>
									<label for="sex" class="form-check-label">F</label>
									<input type="radio" name="sex" value="F" class="form-check-input" <?php echo ($personas[2]['gender'] == "F") ? "checked" : ""; ?>>
								</div>
							</div>
							<div class="mb-3">
								<label for="direccion" class="form-label">Dirección:</label>
								<input type="text" name="direccion" class="form-control" value="<?php echo $personas[2]['addresses'] ?>" required>
							</div>
							<div class="mb-3">
								<label for="pais" class="form-label">País:</label>
								<input type="text" name="pais" class="form-control" value="<?php echo $personas[2]['country'] ?>" required>
							</div>
							<div class="text-center">
								<input type="hidden" name="id" value="<?php echo $_GET['id'] ?>">
								<input type="submit" name="updatePersonas" value="Editar" class="btn btn-warning">
								<br><br><a href="/views/dataTables/dataTablePersonas.php" class="btn btn-info">Ir a Consulta de Personas</a>
								<?php include_once '../links/linkPantallas.php'?>
							</div>
						</form>
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
		<link rel="stylesheet" href="../../css/style.css">
	</head>
	<body class="form-background">
		<div class="container mt-5 text-center">
			<div class="card p-4">
				<nav><?php include_once '../links/linkSinPermisos.php'; ?></nav>
				<a href="../dataTables/dataTablePersonas.php">Ir a Consulta de Personas</a>
			</div>
		</div>
	</body>
	</html>
<?php endif ?>

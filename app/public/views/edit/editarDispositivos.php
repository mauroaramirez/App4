<?php
session_start();
require_once '../../models/Dispositivos.php';

use Clases\Dispositivos;

if ($_SESSION['rol_id'] == 1 || $_SESSION['rol_id'] == 2 || $_SESSION['rol_id'] == null) :

	$dispositivos = new Dispositivos;
	$selectDispositivos = $dispositivos->selectOneDispositivo($_GET['id']);
	$selectMarcas = $dispositivos->selectBrand();
	$selectModelos = $dispositivos->selectModels();

?>
	<!DOCTYPE html>
	<html lang="es">

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Editar Dispositivo</title>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
		<link rel="stylesheet" href="../../css/style.css">
	</head>

	<body class="form-background">
		<div class="container-fluid mt-5">
			<div class="row mb-4 justify-content-center">
				<div class="col-12 col-md-6 col-lg-3">
					<div class="card p-4 text-left">
						<h3 class="text-center">Editar Dispositivo</h3>
						<form action="../../controllers/scriptDispositivos.php" method="post">
							<div class="mb-4">
								<tr>
									<td><label for="marca">Marca:</label></td>
									<td>
										<select name="id_brand" id="marca" class="form-select">
											<?php foreach ($selectMarcas[2] as $key => $value) : ?>
												<option value="<?php echo $value['id'] ?>"><?php echo $value['descripcion'] ?></option>
											<?php endforeach ?>
										</select>
									</td>
								</tr>
							</div>
							<div class="mb-4">
								<tr>
									<td><label for="modelo">Modelo:</label></td>
									<td>
										<select name="id_model" id="modelo" class="form-select">
											<?php foreach ($selectModelos[2] as $key => $value) : ?>
												<option value="<?php echo $value['id'] ?>"><?php echo $value['descripcion'] ?></option>
											<?php endforeach ?>
										</select>
									</td>
								</tr>
							</div>
							<div class="mb-4">
								<label for="imei" class="form-label">IMEI:</label>
								<input type="text" name="imei" class="form-control" placeholder="Ingresar el N° IMEI" value="<?php echo $selectDispositivos[2]['imei'] ?>" required>
							</div>
							<div class="text-center">
								<input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
								<input type="submit" name="updateDispositivo" value="Editar" class="btn btn-warning">
								<br><br><a href="/views/dataTables/dataTableDispositivos.php" class="btn btn-info">Ir a Consulta de Dispositivos</a>
								<?php include_once '../links/linkPantallas.php'; ?>
							</div>
						</form>
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
		<link rel="stylesheet" href="../../css/style.css">
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
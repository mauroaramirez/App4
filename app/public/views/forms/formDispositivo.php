<?php
session_start();

require_once '../../models/Dispositivos.php';

use Clases\Dispositivos;

if ($_SESSION['rol_id'] == 1 || $_SESSION['rol_id'] == 2 ||$_SESSION['rol_id'] == null) :

	$dispositivos = new Dispositivos;

	$selectDispositivos = $dispositivos->selectDispositivos();

	$selectMarcas = $dispositivos->selectBrand();
	$selectModelos = $dispositivos->selectModels();

?>
	<!DOCTYPE html>
	<html lang="es">

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Registro de Dispositivos</title>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
		<link rel="stylesheet" href="../../css/style.css">
	</head>

	<body class="form-background">
	<div class="container-fluid mt-5">
			<div class="row mb-4 justify-content-center">
				<div class="col-12 col-md-6 col-lg-4">
					<div class="card p-4 text-left">
						<h3 class="text-center">Registrar Dispositivo</h3>
						<form action="../../controllers/scriptDispositivos.php" method="post">
							<div class="mb-4">
								<tr>
									<td><label for="marca">Marca:</label></td>
									<td>
										<select name="marca" id="marca" class="form-select">
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
										<select name="modelo" id="modelo" class="form-select">
											<?php foreach ($selectModelos[2] as $key => $value) : ?>
												<option value="<?php echo $value['id'] ?>"><?php echo $value['descripcion'] ?></option>
											<?php endforeach ?>
										</select>
									</td>
								</tr>
							</div>
							<div class="mb-4">
								<label for="imei" class="form-label">IMEI:</label>
								<input type="text" name="imei" class="form-control" required placeholder="Ingresar el N° IMEI">
							</div>
							<div class="text-center">
								<input type="submit" name="newDispositivo" value="Registrar" class="btn btn-primary">
							</div>
						</form>
						<?php include_once '../links/linkPantallas.php' ?>
					</div>
				</div>
			</div>
		</div>
		<?php include_once '../../views/footer/footer.php'?>

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
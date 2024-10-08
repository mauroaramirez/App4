<?php
session_start();

require_once '../../models/Vincular.php';
require_once '../../models/Personas.php';
require_once '../../models/Dispositivos.php';

use Clases\Personas;
use Clases\Dispositivos;

// rol_id = 1 es perfil root
if ($_SESSION['rol_id'] == 1) :

    $dispositivos = new Dispositivos;
    $personas = new Personas;

    $selectPeople = $personas->selectPeople();
    $selectDispositivos = $dispositivos->selectDispositivos();

?>
    <!DOCTYPE html>
    <html lang="es">

    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="../../css/style.css">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Vincular Dispositivos</title>
    </head>

    <body class="form-background">
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-5">
                    <div class="card p-4">
                        <h3 class="text-center">Vincular Dispositivos</h3>
                        <form action="../../controllers/scriptVincular.php" method="post">
                            <table class="table">
                                <tr>
                                    <td><label for="people">Personas:</label></td>
                                    <td>
                                        <select name="people" id="people" class="form-select">
                                            <?php foreach ($selectPeople[2] as $key => $value) : ?>
                                                <option value="<?php echo $value['id'] ?>"><?php echo $value['people'] ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label for="dispositivo">Dispositivo:</label></td>
                                    <td>
                                        <select name="dispositivo" id="dispositivo" class="form-select">
                                            <?php foreach ($selectDispositivos[2] as $key => $value) : ?>
                                                <option value="<?php echo $value['id'] ?>"><?php echo $value['imei'] ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="text-align: center;padding: 5px;">
                                        <input type="submit" name="vincular" class="btn btn-primary" value="Vincular">
                                    </td>
                                </tr>
                            </table>
                            <?php include_once '../links/linkPantallas.php'?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    </body>

    </html>
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

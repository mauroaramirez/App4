<?php
session_start();
require_once '../models/Dispositivos.php';
require_once '../utils/utils.php';

use Clases\Dispositivos;

$dispositivo = new Dispositivos();
$message = "";

if (isset($_POST['newDispositivo'])) {

    $dispositivo->setMarcas($_POST['marca']);
    $dispositivo->setModelo($_POST['modelo']);
    $dispositivo->setImei($_POST['imei']);

    $result = $dispositivo->insert();

    $message = validarResonseQuery($result); 

}

if (isset($_POST['updateDispositivo'])) {

    $dispositivo->setMarcas($_POST['marca']);
    $dispositivo->setModelo($_POST['modelo']);
    $dispositivo->setImei($_POST['imei']);

    $result = $dispositivo->updateDispositivo($_POST['id']);

    $message = validarResonseQueryUpdate($result);
}

if (isset($_POST['deleteDispositivos'])) {

    $result = $dispositivo->deleteDispotivos($_POST['id']);

    $message = validarResonseQueryDelete($result);
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Resultado de Operaciones</title>
</head>

<body class="form-background">
    <div class="container mt-1">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <form action="../../controllers/scriptSession.php" method="post">
                        <div class="text-center">
                            <p>
                            <?php if (!empty($message)): ?>
                                <div class="alert alert-info text-center">
                                    <?php echo $message; ?>
                                </div>
                            <?php endif; ?>
                            </p>
                            <br><a href="/views/dataTables/dataTableDispositivos.php" class="btn btn-secondary">Ir a Consulta de Dispositivos</a>
                            <br><br><a href="../views/forms/formDispositivo.php" class="btn btn-secondary">Ir al Registro de Dispositivos</a>
                            <?php include_once '../views/links/linkPantallas.php'?>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
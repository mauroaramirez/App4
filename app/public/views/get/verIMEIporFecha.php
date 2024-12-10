<?php
session_start();

require_once '../../models/Dispositivos.php';
require_once '../../models/Vincular.php';

use Clases\Vincular;
use Clases\Dispositivos;

$dispositivos = new Dispositivos;
$selectDispositivos = $dispositivos->selectDispositivos();

$vinculados = new Vincular;
$sectVinculados = $vinculados->selectAll();

$GEO_API_BASE_URL = getenv('GEO_API_BASE_URL') ?: $_ENV['GEO_API_BASE_URL'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar por IMEI</title>
    <link href="../css/style.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<style>
    .form-background {
        background-image: url('./static/img/MAPA1.jpg');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        height: 100vh;
        margin: 0;
    }
</style>

<body class="form-background">
    <div class="container-fluid mt-5">
        <div class="row mb-4 justify-content-center">
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card p-4 text-left">
                    <h1 class="text-center mb-4">Consultar Ubicación</h1>
                    <form id="imeiForm">
                        <div class="mb-3">
                            <label for="imei" class="form-label">Seleccionar el Dispositivo:</label>
                            <select id="imei" name="imei" class="form-select text-center" required>
                                <option value="">-- Seleccionar un Dispositivo --</option>
                                <?php foreach ($sectVinculados[2] as $dispositivo) : ?>
                                    <option value="<?= $dispositivo['imei']; ?>">
                                        <?= $dispositivo['titular'] . ' - IMEI: ' . $dispositivo['imei']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="startDate" class="form-label">Fecha Desde:</label>
                            <input type="date" id="startDate" name="start_date" class="form-control" value="<?= date('Y-m-d'); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="endDate" class="form-label">Fecha Hasta:</label>
                            <input type="date" id="endDate" name="end_date" class="form-control" value="<?= date('Y-m-d'); ?>" required>
                        </div>
                        <div class="d-grid gap-2">
                            <button type="button" id="gpsByDateBtn" class="btn btn-info">Consultar por Fechas</button>
                            <?php include_once '../links/linkPantallas.php' ?>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Capturar elementos del DOM
        const imeiSelect = document.getElementById('imei');
        const dateFromInput = document.getElementById('dateFrom');
        const dateToInput = document.getElementById('dateTo');

        // Obtener la URL de la API desde PHP
        const geoApiBaseUrl = "<?= $GEO_API_BASE_URL ?>";

        // Botón para consultar gpsbydate
        document.getElementById('gpsByDateBtn').addEventListener('click', function() {
            const imei = imeiSelect.value;
            const startDate = document.getElementById('startDate').value;
            const endDate = document.getElementById('endDate').value;

            if (imei && startDate && endDate) {
                // Redirigir a gps_request.php con IMEI, rango de fechas y acción
                window.location.href = `../../gps_request.php?imei=${imei}&action=gpsbydate&start_date=${startDate}&end_date=${endDate}`;
            } else {
                alert('Por favor, selecciona un IMEI y completa las fechas.');
            }
        });
    </script>
    <?php include_once '../../views/footer/footer.php' ?>
</body>

</html>
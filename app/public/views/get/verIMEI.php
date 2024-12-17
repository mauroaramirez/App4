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

    .centered-form {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    .card-container {
        width: 100%;
        max-width: 500px;
    }

    .checkbox-container {
        max-height: 300px;
        overflow-y: auto;
    }

    .text-center-custom {
        text-align: center;
    }
</style>

<body class="form-background">
    <div class="container-fluid mt-5 centered-form">
        <div class="card card-container p-4 text-left">
            <h2 class="text-center-custom mb-4">Consultar Ubicación</h2>
            <form id="imeiForm">
                <div class="mb-3">
                    <label class="form-label text-center-custom">Seleccione uno o más dispositivos:</label>
                    <div class="border rounded p-3 checkbox-container">
                        <?php foreach ($sectVinculados[2] as $dispositivo) : ?>
                            <div class="form-check">
                                <input
                                    type="checkbox"
                                    class="form-check-input"
                                    name="imei[]"
                                    value="<?= $dispositivo['imei']; ?>"
                                    id="imei_<?= $dispositivo['imei']; ?>">
                                <label class="form-check-label" for="imei_<?= $dispositivo['imei']; ?>">
                                    <?= $dispositivo['titular'] . ' - IMEI: ' . $dispositivo['imei']; ?>
                                </label>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="d-grid gap-2">
                    <button type="button" id="gpsNowBtn2" class="btn btn-info">Consultar última ubicación</button>
                    <?php include_once '../links/linkPantallas.php' ?>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('gpsNowBtn2').addEventListener('click', function() {
            const imeis = Array.from(document.querySelectorAll('input[name="imei[]"]:checked')).map(input => input.value);

            if (imeis.length > 0) {
                // Redirigir a gps_multiple_request.php con IMEIs seleccionados
                const url = `../../gps_multiple_request.php?imei=${encodeURIComponent(imeis.join(','))}`;
                window.location.href = url;
            } else {
                alert('Por favor, selecciona al menos un dispositivo.');
            }
        });
    </script>
    <?php include_once '../../views/footer/footer.php' ?>
</body>

</html>
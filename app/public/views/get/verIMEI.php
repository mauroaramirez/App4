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
	background-image: url('../static/img/mapa-ciudad.jpeg');
	background-size: cover;
	background-position: center;
	background-repeat: no-repeat;
	height: 100vh;
	margin: 0;
	}

</style>

<body class="form-background">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card p-4">
                    <h1 class="text-center mb-4">Consulta Ubicación por IMEI</h1>
                    <form id="imeiForm">
                        <div class="mb-3">
                            <label for="imei" class="form-label">Ingresa el IMEI:</label>
                            <input type="text" id="imei" name="imei" class="form-control" required>
                        </div>
                        <div class="d-grid gap-2">
                            <button type="button" id="gpsNowBtn" class="btn btn-info">Consultar Última</button><br>
                            <button type="button" id="gpsByAllBtn" class="btn btn-info">Consultar Historial</button>
							<?php include_once '../links/linkPantallas.php'?>
                        </div>
                    </form>
                </div>
            </div>  
        </div>
    </div>

    <script>
        // Capturar IMEI
        const imeiInput = document.getElementById('imei');

        // Botón para consultar gpsnow
        document.getElementById('gpsNowBtn').addEventListener('click', function() {
            const imei = imeiInput.value;
            if (imei) {
                window.location.href = `http://127.0.0.1:5000/gpsnow/${imei}`;
            } else {
                alert('Por favor, ingrese un IMEI.');
            }
        });

        // Botón para consultar gpsbyall
        document.getElementById('gpsByAllBtn').addEventListener('click', function() {
            const imei = imeiInput.value;
            if (imei) {
                window.location.href = `http://127.0.0.1:5000/gpsbyall/${imei}`;
            } else {
                alert('Por favor, ingrese un IMEI.');
            }
        });
    </script>
</body>
</html>

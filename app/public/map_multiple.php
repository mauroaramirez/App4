<?php
session_start();

// Obtener el IMEI de la URL
$imei = $_GET['imei'] ?? null;

// Datos de autenticación
$username = 'admin';
$password = 'password';

// URL del servicio para obtener el historial de ubicaciones
$url = "http://149.50.133.15:5000/gpsbyall/$imei";

// Inicializar cURL
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");

// Ejecutar la petición
$response = curl_exec($ch);

// Verificar si hay algún error en la respuesta
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
    exit();
}

$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
if ($httpCode == 200) {
    $gps_data_list = json_decode($response, true);
} else {
    echo "Error: IMEI not found or server error.";
    exit();
}

// Cerrar cURL
curl_close($ch);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mapa GPS - Historial de Ubicaciones</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
</head>
<body>
    <div id="map" style="height: 1000px; width: 100%;"></div>

    <script type="text/javascript">
        const gpsDataList = <?php echo json_encode($gps_data_list); ?>;

        const map = L.map('map').setView([gpsDataList[0].latitude, gpsDataList[0].longitude], 17);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        // Iterar sobre cada registro GPS y añadir un marcador para cada uno
        gpsDataList.forEach(function(gpsData) {
            L.marker([gpsData.latitude, gpsData.longitude]).addTo(map)
                .bindPopup(`<b>Ubicación registrada en: ${gpsData.timestamp}</b>`);
        });
    </script>
</body>
</html>

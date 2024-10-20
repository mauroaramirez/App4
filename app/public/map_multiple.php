<?php
session_start();

// Obtener el IMEI de la URL
$imei = $_GET['imei'] ?? null;

// Datos de autenticación
$username = getenv('USERNAME_TOKEN') ?: $_ENV['USERNAME_TOKEN'];
$password = getenv('PASSWORD_TOKEN') ?: $_ENV['PASSWORD_TOKEN'];
$gps_api_url = getenv('GPS_API_URL') ?: $_ENV['GPS_API_URL'];

// URL del servicio para obtener el historial de ubicaciones
$url = "$gps_api_url/gpsbyall/$imei";

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

        // Asegúrate de que gpsDataList no esté vacío
        if (gpsDataList.length > 0) {
            // Usa el último registro para centrar el mapa
            const lastData = gpsDataList[gpsDataList.length - 1];
            const map = L.map('map').setView([lastData.latitude, lastData.longitude], 17);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            // Añadir un marcador para la última ubicación
            L.marker([lastData.latitude, lastData.longitude]).addTo(map)
                .bindPopup(`<b>Última ubicación registrada en: ${lastData.timestamp}</b>`).openPopup();

            // Iterar sobre cada registro GPS y añadir un marcador para cada uno
            gpsDataList.forEach(function(gpsData) {
                L.marker([gpsData.latitude, gpsData.longitude]).addTo(map)
                    .bindPopup(`<b>Ubicación registrada en: ${gpsData.timestamp}</b>`);
            });
        } else {
            alert("No hay datos GPS disponibles para mostrar.");
        }
    </script>
</body>
</html>

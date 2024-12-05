<?php
session_start();

// Verificar si los datos GPS están en la sesión
if (!isset($_SESSION['gps_data']) || empty($_SESSION['gps_data'])) {
    echo "No se encontraron datos GPS para mostrar.";
    exit();
}

// Obtener los datos GPS de la sesión
$gps_data_list = $_SESSION['gps_data'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mapa GPS - Historial por Rango de Fechas</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
</head>

<body>
    <div id="map" style="height: 1000px; width: 100%;"></div>

    <script type="text/javascript">
        const gpsDataList = <?php echo json_encode($gps_data_list); ?>;

        if (gpsDataList.length > 0) {
            // Último registro para centrar el mapa
            const lastData = gpsDataList[gpsDataList.length - 1];
            const map = L.map('map').setView([lastData.latitude, lastData.longitude], 17);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            // Añadir un marcador para la última ubicación con IMEI
            L.marker([lastData.latitude, lastData.longitude]).addTo(map)
                .bindPopup(`<b>IMEI:</b> ${lastData.imei}<br>
                            <b>Última ubicación registrada:</b><br>
                            <b>Fecha:</b> ${lastData.timestamp}`).openPopup();

            // Dibujar un marcador para cada ubicación en el rango con IMEI
            gpsDataList.forEach(function(gpsData) {
                L.marker([gpsData.latitude, gpsData.longitude]).addTo(map)
                    .bindPopup(`<b>IMEI:</b> ${gpsData.imei}<br>
                                <b>Ubicación registrada:</b><br>   
                                <b>Fecha:</b> ${gpsData.timestamp}`);
            });

        } else {
            alert("No hay datos GPS disponibles para mostrar en este rango de fechas.");
        }
    </script>
</body>

</html>
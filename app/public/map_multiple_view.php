<?php
session_start();
$gps_data_all = $_SESSION['gps_data_all'] ?? [];

if (empty($gps_data_all)) {
    echo "No se encontraron datos para los dispositivos seleccionados.";
    exit();
}

// Función para calcular la diferencia en días entre la fecha actual y el timestamp
function getDaysDifference($timestamp)
{
    $currentDate = new DateTime();
    $gpsDate = new DateTime($timestamp);
    $interval = $currentDate->diff($gpsDate);
    return $interval->days;
}

// Función para determinar el color del marcador según la diferencia en días
function getMarkerColor($timestamp)
{
    $daysDifference = getDaysDifference($timestamp);

    if ($daysDifference <= 1) {
        return "green"; // Verde si es un día o menos
    } elseif ($daysDifference > 1 && $daysDifference <= 5) {
        return "yellow"; // Amarillo si tiene entre 2 y 5 días
    } elseif ($daysDifference > 5 && $daysDifference <= 10) {
        return "orange"; // Naranja si tiene entre 6 y 10 días
    } else {
        return "red"; // Rojo si tiene más de 10 días
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Última Ubicación de Dispositivos</title>
    <!-- Incluye Leaflet -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <style>
        #map {
            width: 100%;
            height: 1000px;
        }
    </style>
</head>

<body>
    <div id="map"></div>
    <script>
        var map = L.map('map').setView([0, 0], 2); // Inicializa el mapa en un lugar genérico

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        var markers = [];
        var lastDeviceMarker = null; // Último marcador mostrado
        var bounds = L.latLngBounds(); // Para ajustar el zoom cuando hay más de un dispositivo

        <?php foreach ($gps_data_all as $data): ?>
            var lat = <?= $data['latitude'] ?>;
            var lon = <?= $data['longitude'] ?>;
            var imei = '<?= $data['imei'] ?>';
            var timestamp = '<?= $data['timestamp'] ?>';
            var markerColor = '<?= getMarkerColor($data['timestamp']) ?>';

            // Determinar el mensaje según el color del marcador
            var popupMessage;
            switch (markerColor) {
                case 'green':
                    popupMessage = "<b>Ubicación registrada en: " + timestamp + "</b><br><b>Un día o menos sin actividad</b><br><b>IMEI: " + imei + "</b>";
                    break;
                case 'yellow':
                    popupMessage = "<b>Ubicación registrada en: " + timestamp + "</b><br><b>Entre 2 y 5 días sin actividad</b><br><b>IMEI: " + imei + "</b>";
                    break;
                case 'orange':
                    popupMessage = "<b>Ubicación registrada en: " + timestamp + "</b><br><b>Entre 6 y 10 días sin actividad</b><br><b>IMEI: " + imei + "</b>";
                    break;
                case 'red':
                    popupMessage = "<b>Ubicación registrada en: " + timestamp + "</b><br><b>Más de 10 días sin actividad</b><br><b>IMEI: " + imei + "</b>";
                    break;
            }

            // Crear marcador
            var marker = L.marker([lat, lon], {
                    icon: L.divIcon({
                        className: 'marker-icon marker-' + markerColor,
                        iconSize: [32, 32],
                        html: "<div style='background-color: " + markerColor + "; width: 32px; height: 32px; border-radius: 50%; border: 2px solid black;'></div>"
                    })
                })
                .bindPopup(popupMessage)
                .addTo(map);

            markers.push(marker);
            bounds.extend(marker.getLatLng()); // Extiende los límites del mapa para incluir este marcador

            // Si es el último dispositivo, se guarda para centrarlo más tarde
            lastDeviceMarker = marker;
        <?php endforeach; ?>

        // Ajusta el zoom según el número de dispositivos
        if (markers.length === 1) {
            // Si solo hay un dispositivo, hace zoom en ese marcador
            map.setView(lastDeviceMarker.getLatLng(), 17);
        } else {
            // Si hay más de un dispositivo, ajusta el zoom para incluir todos
            map.fitBounds(bounds);
        }
    </script>
</body>

</html>
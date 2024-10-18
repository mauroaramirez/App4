<?php
// Obtener los parámetros de latitud, longitud y descripción (timestamp) desde la URL
$latitude = $_GET['lat'];
$longitude = $_GET['lon'];
$timestamp = $_GET['desc'];

// Función para calcular la diferencia en días entre la fecha actual y el timestamp
function getDaysDifference($timestamp) {
    $currentDate = new DateTime();
    $gpsDate = new DateTime($timestamp);
    $interval = $currentDate->diff($gpsDate);
    return $interval->days; // Devolvemos la diferencia en días
}

// Determinar el color del marcador según la diferencia en días
function getMarkerColor($timestamp) {
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

// Obtener el color según la fecha
$markerColor = getMarkerColor($timestamp);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mapa GPS</title>
    <!-- Incluye la librería Leaflet para generar el mapa -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <style>
        #map {
            height: 1000px;
            width: 100%;
        }
        /* Estilo del marcador con el color dinámico */
        .marker-green {
            background-color: green;
        }
        .marker-yellow {
            background-color: yellow;
        }
        .marker-orange {
            background-color: orange;
        }
        .marker-red {
            background-color: red;
        }
        .marker-icon {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            border: 2px solid #000;
        }
    </style>
</head>
<body>
    <div id="map"></div>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script>
        // Crear el mapa centrado en la latitud y longitud obtenidas
        var map = L.map('map').setView([<?php echo $latitude; ?>, <?php echo $longitude; ?>], 17);

        // Cargar un mapa base de OpenStreetMap
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        // Añadir un marcador en la ubicación con una descripción y un color basado en el timestamp
        var marker = L.marker([<?php echo $latitude; ?>, <?php echo $longitude; ?>], {
            icon: L.divIcon({
                className: 'marker-icon marker-<?php echo $markerColor; ?>',
                iconSize: [32, 32],
                html: '<div class="marker-icon"></div>' // Representación del marcador
            })
        }).addTo(map);

        // Determinar el mensaje según el color del marcador
        var popupMessage;
        switch ('<?php echo $markerColor; ?>') {
            case 'green':
                popupMessage = "<b>Ubicación registrada en: <?php echo $timestamp; ?></b><br><b>Un día o menos sin actividad</b>";
                break;
            case 'yellow':
                popupMessage = "<b>Ubicación registrada en: <?php echo $timestamp; ?></b><br><b>Entre 2 y 5 días sin actividad</b>";
                break;
            case 'orange':
                popupMessage = "<b>Ubicación registrada en: <?php echo $timestamp; ?></b><br><b>Entre 6 y 10 días sin actividad</b>";
                break;
            case 'red':
                popupMessage = "<b>Ubicación registrada en: <?php echo $timestamp; ?></b><br><b>Más de 10 días sin actividad</b>";
                break;
        }

        // Mostrar el popup con la información de la ubicación
        marker.bindPopup(popupMessage).openPopup();
    </script>
</body>
</html>

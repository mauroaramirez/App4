<?php
session_start();

// Datos de autenticación
$username = getenv('USERNAME_TOKEN') ?: $_ENV['USERNAME_TOKEN'];
$password = getenv('PASSWORD_TOKEN') ?: $_ENV['USERNAME_TOKEN'];
$gps_api_url = getenv('GPS_API_URL') ?: $_ENV['GPS_API_URL'];

// Obtener datos del formulario
$imei = $_GET['imei'] ?? null;
$start_date = $_GET['start_date'] ?? null;
$end_date = $_GET['end_date'] ?? null;

if (isset($_GET['action'])) {
    $action = $_GET['action'];

    // URL del servicio según la acción
    switch ($action) {
        case 'gpsnow2':
            $url = "$gps_api_url/gpsnow/$imei";
            break;

        case 'gpsbyall2':
            // Redirigir a map_multiple.php
            header("Location: map_multiple.php?imei=$imei");
            exit();

        case 'gpsbydate':
            if ($start_date && $end_date) {
                $url = "$gps_api_url/gpsbydate/$imei?start_date=$start_date&end_date=$end_date";
            } else {
                echo "Error: Falta especificar las fechas.";
                exit();
            }
            break;

        default:
            echo "Acción no válida.";
            exit();
    }

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
        if ($action === 'gpsbydate') {
            $gps_data = json_decode($response, true);
        
            // Redirigir al mapa con el historial
            $_SESSION['gps_data'] = $gps_data;
            header("Location: map_multiple_bydate.php?imei=$imei");
            exit();
        }
         else {
            $gps_data = json_decode($response, true)[0];
            $latitude = $gps_data['latitude'];
            $longitude = $gps_data['longitude'];
            $timestamp = $gps_data['timestamp'];

            header("Location: map.php?lat=$latitude&lon=$longitude&desc=$timestamp");
            exit();
        }
    } elseif ($httpCode == 404) {
        include_once '../public/views/error.php';
    } elseif ($httpCode == 401) {
        echo "Error: Unauthorized access.";
    } else {
        echo "Error: Server error.";
    }

    // Cerrar cURL
    curl_close($ch);
} else {
    echo "No se ha especificado una acción.";
}

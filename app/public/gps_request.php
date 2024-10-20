<?php
session_start();

// Datos de autenticación
$username = getenv('USERNAME_TOKEN') ?: $_ENV['USERNAME_TOKEN'];
$password = getenv('PASSWORD_TOKEN') ?: $_ENV['PASSWORD_TOKEN'];
$gps_api_url = getenv('GPS_API_URL') ?: $_ENV['GPS_API_URL'];

// Obtener el IMEI del formulario
$imei = $_GET['imei'] ?? null;

if (isset($_GET['action'])) {
    $action = $_GET['action'];

    // URL del servicio según la acción
    if ($action === 'gpsnow2') {
        $url = "$gps_api_url/gpsnow/$imei";
    } elseif ($action === 'gpsbyall2') {
        // Redirigir a map_multiple.php
        header("Location: map_multiple.php?imei=$imei");
        exit();
    } else {
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
        $gps_data = json_decode($response, true)[0];
        // Almacenar los datos en variables
        $latitude = $gps_data['latitude'];
        $longitude = $gps_data['longitude'];
        $timestamp = $gps_data['timestamp'];

        header("Location: map.php?lat=$latitude&lon=$longitude&desc=$timestamp");
        exit();
    } elseif ($httpCode == 404) {
        echo "Error: IMEI not found.";
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
?>

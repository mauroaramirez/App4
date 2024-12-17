<?php
session_start();

// Datos de autenticación
$username = getenv('USERNAME_TOKEN') ?: $_ENV['USERNAME_TOKEN'];
$password = getenv('PASSWORD_TOKEN') ?: $_ENV['USERNAME_TOKEN'];
$gps_api_url = getenv('GPS_API_URL') ?: $_ENV['GPS_API_URL'];

// Obtener los IMEIs desde la URL (se espera una lista separada por comas)
$imeis = $_GET['imei'] ?? null;
if ($imeis) {
    $imeis_array = explode(',', $imeis); // Convertir la cadena de IMEIs en un array
} else {
    $_SESSION['error_message'] = 'No se han proporcionado IMEIs.';
    include_once '../public/views/error.php';
    exit();
}

$gps_data_all = [];

// Obtener los datos de cada IMEI
foreach ($imeis_array as $imei) {
    $url = "$gps_api_url/gpsnow/$imei";

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
        $gps_data = json_decode($response, true)[0]; // Obtener el primer registro
        $gps_data_all[] = $gps_data; // Guardar los datos
    }
    // Cerrar cURL
    curl_close($ch);
}

// Verificar si tenemos datos
if (!empty($gps_data_all)) {
    // Guardar los datos en sesión para usarlos en el mapa
    $_SESSION['gps_data_all'] = $gps_data_all;

    // Redirigir a map_multiple_view.php para mostrar los datos
    header("Location: map_multiple_view.php");
    exit();
} else {
    $_SESSION['error_message'] = 'No se encontraron ubicaciones para los dispositivos seleccionados.';
    include_once '../public/views/no_records.php';
    exit();
}

<?php

$imei = $_POST['imei'];  

//$url = GEO_API_BASE_URL"./gpsbyall/$imei";
//$username = 'user'; // esto lo tenes en variables de entornos
//$password = 'password'; // esto lo tenes en variables de entornos

$baseUrl = getenv('GEO_API_BASE_URL');
$username = getenv('GEO_API_USERNAME');
$password = getenv('GEO_API_PASSWORD');

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");

$response = curl_exec($ch);


if (curl_errno($ch)) {
    echo 'Error en la solicitud: ' . curl_error($ch);
} else {
    $data = json_decode($response, true);
    if ($data) {
        echo "Muestro Mapa\n";
        
    } else {
        echo "No se obtuvieron datos para mostrar el mapa válidos.\n";
    }
}

curl_close($ch);
?>
<?php
session_start();
require_once '../models/Dispositivos.php';
require_once '../utils/utils.php';

use Clases\Dispositivos;

$dispositivo = new Dispositivos();

$dispositivo->setMarcas($_POST['marca']);
$dispositivo->setModelo($_POST['modelo']);
$dispositivo->setImei($_POST['imei']);

$result = $dispositivo->insert();

validarResonseQuery($result);

echo '<br><br><a href="../views/forms/formDispositivo.php">Ir al Registro de Dispositivos</a>';
echo '<br><br><a href="/views/index.php">Ir a Menú Principal</a>';
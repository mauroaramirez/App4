<?php
session_start();
require_once '../models/Dispositivos.php';
require_once '../utils/utils.php';

use Clases\Dispositivos;

$dispositivo = new Dispositivos();

if (isset($_POST['newDispositivo'])) {

    $dispositivo->setMarcas($_POST['marca']);
    $dispositivo->setModelo($_POST['modelo']);
    $dispositivo->setImei($_POST['imei']);

    $result = $dispositivo->insert();

    validarResonseQuery($result);

}

if (isset($_POST['updateDispositivo'])) {

    $dispositivo->setMarcas($_POST['marca']);
    $dispositivo->setModelo($_POST['modelo']);
    $dispositivo->setImei($_POST['imei']);

    $result = $dispositivo->updateDispositivo($_POST['id']);

    validarResonseQueryUpdate($result);
}

if (isset($_POST['deleteDispositivos'])) {

    $result = $dispositivo->deleteDispotivos($_POST['id']);

    validarResonseQueryDelete($result);
}

echo '<br><br><a href="/views/dataTables/dataTableDispositivos.php">Ir a Consulta de Dispositivos</a>';
echo '<br><br><a href="../views/forms/formDispositivo.php">Ir al Registro de Dispositivos</a>';
echo '<br><br><a href="/views/index.php">Ir a Menú Principal</a>';
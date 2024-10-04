<?php
session_start();
require_once '../models/Vincular.php';
require_once '../utils/utils.php';

use Clases\Vincular;

$asociar = new Vincular();

if (isset($_POST['vincular'])) {

    $asociar->setPersona($_POST['persona']);
    $asociar->setDispositivo($_POST['dispositivo']);

    $result = $asociar->insert();

    validarResonseQuery($result);
}

if (isset($_POST['updateAuto'])) {

    $asociar->setPersona($_POST['persona']);
    $asociar->setDispositivo($_POST['dispositivo']);

    $result = $asociar->update($_POST['id']);

    validarResonseQueryUpdate($result);
}

if (isset($_POST['deleteAuto'])) {

    $result = $asociar->delete($_POST['id']);

    validarResonseQueryDelete($result);
}

echo '<br><br><a href="../views/forms/formVincular.php">Ir a Vincular dispositivos</a>';
echo '<br><br><a href="/views/index.php">Ir a Menú Principal</a>';

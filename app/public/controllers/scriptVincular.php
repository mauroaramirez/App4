<?php
session_start();
require_once '../models/Asociar.php';
require_once '../utils/utils.php';

use Clases\Asociar;

$asociar = new Asociar();

if (isset($_POST['vincular'])) {

    $asociar->setPersona($_POST['persona']);
    $asociar->setDispositivo($_POST['dispositivo']);
    //$auto->setTitular($_POST['titular']);
    //$auto->setTipoVehiculo($_POST['tipoVehiculo']);
    //$auto->setTipoCarroceria($_POST['tipoCarroceria']);
    //$auto->setTipoTransmision($_POST['tipoTransmision']);
    //$auto->setTipoMotor($_POST['tipoMotor']);
    //$auto->setPeso($_POST['peso']);
    //$auto->setRodado($_POST['rodado']);
    //$auto->setColor($_POST['color']);

    $result = $asociar->insert();

    validarResonseQuery($result);
}

if (isset($_POST['updateAuto'])) {

    $asociar->setPersona($_POST['persona']);
    $asociar->setDispositivo($_POST['dispositivo']);
    //$asociar->setTitular($_POST['titular']);
    //$asociar->setTipoVehiculo($_POST['tipoVehiculo']);
    //$asociar->setTipoCarroceria($_POST['tipoCarroceria']);
    //$asociar->setTipoTransmision($_POST['tipoTransmision']);
    //$asociar->setTipoMotor($_POST['tipoMotor']);
    //$asociar->setPeso($_POST['peso']);
    //$asociar->setRodado($_POST['rodado']);
    //$asociar->setColor($_POST['color']);

    $result = $asociar->update($_POST['id']);

    validarResonseQueryUpdate($result);
}

if (isset($_POST['deleteAuto'])) {

    $result = $asociar->delete($_POST['id']);

    validarResonseQueryDelete($result);
}

echo '<br><br><a href="../views/forms/formAsociar.php">Ir a Vincular dispositivos</a>';
echo '<br><br><a href="/views/index.php">Ir a Menú Principal</a>';

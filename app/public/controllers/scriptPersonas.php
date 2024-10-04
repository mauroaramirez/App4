<?php
session_start();
require_once '../models/Personas.php';
require_once '../utils/utils.php';

use Clases\Personas;

$peronas = new Personas();

if (isset($_POST['newTitular'])) {

    $peronas->setNombre($_POST['nombre']);
    $peronas->setApellido($_POST['apellido']);
    $peronas->setDni($_POST['dni']);
    $peronas->setSexo($_POST['sex']);
    $peronas->setEmail($_POST['email']);
    $peronas->setDireccion($_POST['direccion']);
    $peronas->setPais($_POST['pais']);
    $peronas->setPass($_POST['pass']);

    $result = $peronas->insert();

    validarResonseQuery($result);
}

if (isset($_POST['updatePersonas'])) {

    $peronas->setNombre($_POST['nombre']);
    $peronas->setApellido($_POST['apellido']);
    $peronas->setDni($_POST['dni']);
    $peronas->setSexo($_POST['sex']);
    $peronas->setEmail($_POST['email']);
    $peronas->setDireccion($_POST['direccion']);
    $peronas->setPais($_POST['pais']);
    //$peronas->setPass($_POST['pass']);

    $result = $peronas->update($_POST['id']);

    validarResonseQueryUpdate($result);
}

if (isset($_POST['deletePersonas'])) {

    $result = $peronas->delete($_POST['id']);

    validarResonseQueryDelete($result);
}

echo '<br><br><a href="/views/dataTables/dataTablePersonas.php">Ir a Consulta de Personas</a>';
echo '<br><br><a href="../views/forms/formPersonas.php">Ir al Registro de Personas</a>';
echo '<br><br><a href="/views/index.php">Ir a Menú Principal</a>';

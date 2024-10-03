<?php
session_start();
require_once '../models/Personas.php';
require_once '../utils/utils.php';

use Clases\Personas;

$personas = new Personas();

if (isset($_POST['newTitular'])) {

    $personas->setNombre($_POST['nombre']);
    $personas->setApellido($_POST['apellido']);
    $personas->setDni($_POST['dni']);
    $personas->setSexo($_POST['sex']);
    $personas->setEmail($_POST['email']);
    $personas->setDireccion($_POST['direccion']);
    $personas->setPais($_POST['pais']);
    $personas->setPass($_POST['pass']);

    $result = $personas->insert();

    validarResonseQuery($result);
}

if (isset($_POST['updatePersonas'])) {

    $personas->setNombre($_POST['nombre']);
    $personas->setApellido($_POST['apellido']);
    $personas->setDni($_POST['dni']);
    $personas->setSexo($_POST['sex']);
    $personas->setEmail($_POST['email']);
    $personas->setDireccion($_POST['direccion']);
    $personas->setPais($_POST['pais']);
    //$peronas->setPass($_POST['pass']);

    $result = $personas->update($_POST['id']);

    validarResonseQueryUpdate($result);
}

if (isset($_POST['deletePersonas'])) {

    $result = $personas->delete($_POST['id']);

    validarResonseQueryDelete($result);
}

echo '<br><br><a href="/views/dataTables/dataTablePersonas.php">Ir a Consulta de Personas</a>';
echo '<br><br><a href="/views/index.php">Ir a Menú Principal</a>';

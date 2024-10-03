<?php
session_start();
require_once './Clases/Modelos.php';
require_once '../utils/utils.php';

use Clases\Modelos;

$modelo = new Modelos();

$modelo->setModelos($_POST['modelo']);
$modelo->setMarcas($_POST['marca']);


$result = $modelo->insert();

validarResonseQuery($result);

echo '<br><br><a href="./formModelos.php">Ir a Formulario Modelos</a>';
echo '<br><br><a href="./index.php">Ir a Menú Principal</a>';
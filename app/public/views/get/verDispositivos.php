<?php
//session_start();
require_once '../../models/Dispositivos.php';

use Clases\Dispositivos;

$personas = new Dispositivos;

$personas = $personas->selectOne($_GET['id']);

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Ver Dispositivo</title>
</head>

<body>
	<center>
		<h3>Datos del Dispositivo</h3>
		<div style="border: 1px solid; width: 50%;padding: 2px;">
			<b>ID: </b><?php echo $personas[2]['id'] ?><br>
			<b>Marca: </b><?php echo $personas[2]['marca'] ?><br>
			<b>Modelo: </b><?php echo $personas[2]['modelo'] ?><br>
			<b>IMEI: </b><?php echo $personas[2]['imei'] ?><br>
		</div>
		<br>
		<a href="../../views/dataTables/dataTableDispositivos.php">Ir a Consulta de Dispositivos</a>
	</center>

</body>

</html>
<?php
session_start();
require_once './Clases/Autos.php';

use Clases\Vincular;

$autos = new Vincular;

$autos = $autos->selectOne($_GET['id']);

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Ver Autos</title>
</head>

<body>
	<center>
		<h3>Datos del Auto</h3>
		<div style="border: 1px solid; width: 50%;padding: 2px;">
			<b>Marca: </b><?php echo $autos[2]['marca'] ?><br>
			<b>Modelo: </b><?php echo $autos[2]['modelo'] ?><br>
			<b>Titular: </b><?php echo $autos[2]['titular'] ?><br>
			<b>Tipo Vehiculo: </b><?php echo $autos[2]['tipo_vehiculo'] ?><br>
			<b>Tipo Transmicion: </b><?php echo $autos[2]['tipo_transmicion'] ?><br>
			<b>Tipo Motor: </b><?php echo $autos[2]['tipo_motor'] ?><br>
			<b>Peso: </b><?php echo $autos[2]['peso'] ?><br>
			<b>Rodado: </b><?php echo $autos[2]['rodado'] ?><br>
			<b>Color: </b><?php echo $autos[2]['color'] ?><br>
		</div>
		<br>
		<a href="./dataTableAutos.php">Ir a Consulta de Autos</a>
	</center>
</body>

</html>
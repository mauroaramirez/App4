<?php
//session_start();
require_once '../../models/Personas.php';

use Clases\Personas;

$personas = new Personas;

$personas = $personas->selectOne($_GET['id']);

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Ver Persona</title>
</head>

<body>
	<center>
		<h3>Datos del Titular</h3>
		<div style="border: 1px solid; width: 50%;padding: 2px;">
			<b>Titular: </b><?php echo $personas[2]['titular'] ?><br>
			<b>DNI: </b><?php echo $personas[2]['dni'] ?><br>
			<b>Sexo: </b><?php echo $personas[2]['sexo'] ?><br>
			<b>Email: </b><?php echo $personas[2]['email'] ?><br>
			<b>Dirección: </b><?php echo $personas[2]['direccion'] ?><br>
			<b>País: </b><?php echo $personas[2]['pais'] ?><br>
		</div>
		<br>
		<a href="../../views/dataTables/dataTablePersonas.php">Ir a Consulta de Personas</a>
	</center>

</body>

</html>
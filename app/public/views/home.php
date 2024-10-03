<?php
session_start();
if (isset($_SESSION['id'])) {
?>
	<!DOCTYPE html>
	<html lang="en">

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Geolocalización</title>
	</head>
	<body>
		<p>
			<b>Usuario: </b><?php echo $_SESSION['personas'] ?>
			<b>Rol: </b><?php echo $_SESSION['rol'] ?>
			<b>Email: </b><?php echo $_SESSION['email'] ?><br>
		</p>
		<br>
		<a href="./forms/formPersonas.php">Registrar Personas</a><br>
		<br>
		<a href="./forms/formDispositivo.php">Registrar Dispositivos</a><br>
		<br>
		<a href="./forms/formAsociar.php">Asociar Dispositivos</a><br>
		<br>
		<a href="./dataTables/dataTablePersonas.php">Consulta Personas</a><br>
		<br>
		<a href="./dataTables/dataTableAutos.php">Consulta Dispositivos</a><br>
		<br><br>
		<a href="./logout.php" style="margin-right: 2px;">Cerrar sesión</a>
	</body>

	</html>
<?php
} else {
	echo "No estas logeado";
	echo '<br><a href="./login.php">Log in</a>';
}

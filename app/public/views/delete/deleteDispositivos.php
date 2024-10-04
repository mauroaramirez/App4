<?php
session_start();
include_once '../get/verDispositivos.php';

if ($_SESSION['rol_id'] == 1) :

?>
	<center>
		<h3>Confirmar que va a borrar</h3>
		<form action="../../controllers/scriptDispositivos.php" method="post">
			<input type="hidden" name="id" value="<?php echo $_GET['id'] ?>">
			<input type="submit" name="deleteDispositivos" value="Confirmar">
		</form>
	</center>
<?php else : ?>
	<center>
		<nav><?php include_once '../links/linkSinPermisos.php' ?></nav>
	</center>
<?php endif ?>
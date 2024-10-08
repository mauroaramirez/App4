<?php
session_start();
include_once '../get/verDispositivos.php';

if ($_SESSION['rol_id'] == 1) :

	?>
	<center>
		<body class="form-background"> 
			<div class="container mt-4">
				<div class="row justify-content-center">
					<div class="col-md-5">
						<div class="card p-3">
							<form action="../../controllers/scriptDispositivos.php" method="post" onsubmit="return confirmarEliminacion();">
								<input type="hidden" name="id" value="<?php echo $_GET['id'] ?>">
								<p>Confirmar eliminación de Dispositivo:</p>
								<input type="submit" name="deleteDispositivos" class="row justify-content-center" value="Confirmar">
							</form>
						</div>
					</div>
				</div>
			</div>
			<script>
				function confirmarEliminacion() {
					return confirm('¿Estás seguro de que deseas eliminar este dispositivo?');
				}
			</script>
		</body>
	</center>
	
		
	<?php else : ?>
		<center>
			<nav><?php include_once '../links/linkSinPermisos.php' ?></nav>
		</center>
	<?php endif ?>

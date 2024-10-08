<?php
session_start();
include_once '../get/verPersonas.php';

if ($_SESSION['rol_id'] == 1) :

?>
<center>
    <body class="form-background"> <!-- Aplicamos la clase para el fondo -->
        <div class="container mt-4">
            <div class="row justify-content-center">
                <div class="col-md-5">
                    <div class="card p-3">
                        <form action="../../controllers/scriptPersonas.php" method="post" onsubmit="return confirmarEliminacion();">
                            <input type="hidden" name="id" value="<?php echo $_GET['id'] ?>">
                            <p>Confirmar eliminación de Persona:</p>
                            <input type="submit" name="deletePersonas" class="row justify-content-center btn btn-danger" value="Confirmar">
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- JavaScript para mostrar la confirmación -->
        <script>
            function confirmarEliminacion() {
                return confirm('¿Estás seguro de que deseas eliminar esta persona?');
            }
        </script>
    </body>
</center>

	
<?php else : ?>
	<center>
		<nav><?php include_once '../links/linkSinPermisos.php' ?></nav>
	</center>
<?php endif ?>
<?php
session_start();
require_once '../models/Session.php';

use Clases\Session;

$session = new Session();
$session->setDni($_POST['dni']);
$session->setPass($_POST['pass']);

$result = $session->login();
$pass = $session->getPass();

if ($result[1] != 0) {
	if (password_verify($pass, $result[2][0]['pass'])) {
		$_SESSION['personas'] = $result[2][0]['personas'];
		$_SESSION['id'] = $result[2][0]['id'];
		$_SESSION['email'] = $result[2][0]['email'];
		$_SESSION['country'] = $result[2][0]['country'];
		$_SESSION['id_status'] = $result[2][0]['id_status'];
		$_SESSION['rol_id'] = $result[2][0]['rol_id'];
		$_SESSION['rol'] = $result[2][0]['rol'];

		// Redirigir antes de enviar cualquier salida
		header('Location: ../views/home.php');
		exit();
	} else {
		$error_message = "Clave incorrecta. Intente nuevamente.";
	}
} else {
	$error_message = "Usuario no registrado. Registre su usuario.";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Autenticación</title>
	<link href="../css/style.css" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
	<div class="container mt-5">
		<div class="row justify-content-center">
			<div class="col-md-5">
				<div class="card p-4">
					<?php
					if (isset($error_message)) {
						echo "<h4>$error_message</h4>";
						echo '<br><a href="../views/login.php" class="btn btn-danger btn-sm">Ir a Log In</a>';
					}
					?>
				</div>
			</div>
		</div>
	</div>
</body>

</html>
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
		$_SESSION['pais'] = $result[2][0]['pais'];
		$_SESSION['estado'] = $result[2][0]['estado'];
		$_SESSION['rol_id'] = $result[2][0]['rol_id'];
		$_SESSION['rol'] = $result[2][0]['rol'];

		header('Location:../views/home.php');
	} else {
		echo "Clave incorrecta. Intente nuevamente";
		echo '<br><br><a href="../views/login.php">Log In</a>';
	}
} else {
	echo "Usuario no registrado. Registre su usuario";
	echo '<br><br><a href="./login.php">Log In</a>';
}

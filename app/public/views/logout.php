<?php
session_start();

if (isset($_SESSION['rol_id'])) {
	session_destroy();
	unset($_SESSION['socio']);
	unset($_SESSION['id']);
	unset($_SESSION['email']);
	unset($_SESSION['pais']);
	unset($_SESSION['estado']);
	unset($_SESSION['rol_id']);
	unset($_SESSION['rol']);
}

header('Location:index.php');

<?php
session_start();

if (isset($_SESSION['rol'])) {
	header('Location:home.php');
} else {
	header('Location:login.php');
}

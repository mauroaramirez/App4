<?php
session_start();
ob_start();
date_default_timezone_set('America/Argentina/Buenos_Aires');

$folderPath = dirname($_SERVER['SCRIPT_NAME']);
$urlPath = $_SERVER['REQUEST_URI'];
$url = substr($urlPath, strlen($folderPath));

define('URL', $url);
define('SITE', $folderPath);

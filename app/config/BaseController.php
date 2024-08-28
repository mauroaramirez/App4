<?php

namespace App\config;

abstract class BaseController
{

	protected function renderView($path, $params = [])
	{

		include_once '../Views/base.php';
	}

	protected function redirectTo($route)
	{

		header("Location: " . SITE . $route);
	}

	protected function addAlert($message)
	{
		echo '<script>        
        		alert("' . $message . '");
        	</script>';
	}
}

<?php 

namespace App\config;

class Router {

	private $controller;
	private $method;
	private $url;

	public function __construct() {
		$this->matchRoute();
	}

	public function matchRoute() {

		$this->url = explode("/", URL);
		var_dump(value: URL);
		echo "<br>";
		var_dump($this->url);

		$this->controller = !empty($this->url[0]) ? $this->url[0] : 'home';

		$this->method = !empty($this->url[1]) ? $this->url[1] : 'index';

		$this->controller = ucfirst($this->controller).'Controller';

		$controllerExists = '../Controllers/'.$this->controller.'.php';

		# se valida que exista la clase
		if(file_exists($controllerExists)) {

			require_once '../Controllers/'.$this->controller.'.php';

		# se excluyen los scripts ajax		
		} elseif ( ($this->url[0] == "services") && ($this->url[1] == "ajax") ) {

			include_once "../".ucfirst(URL);
			exit();

		} else {

			$this->controller = 'HomeController';
			$this->method = 'errorURL';
			require_once '../Controllers/'.$this->controller.'.php';

		}
		
	}

	public function run() {

		$namespace = 'App\Controllers\\'.$this->controller;
		$controller = new $namespace;
		$method = $this->method;		
		
		# se valida que exista el metodo
		if (method_exists($controller, $method)) {
			/*
				Si el array de la url tiene más de 2 indices, entonces quiere
				decir que debo cargar un controlador que recive parametros,
				tener en cuenta que los parametros se ven en el navegador.
				De ser necesario se pueden agregar más 'case' para pasar
				más parametros.
			*/
			$params = count($this->url);

			switch ($params) {
				case 3:
					$controller->$method($this->url[2]);
					break;
				
				default:
					$controller->$method();
					break;
			}
		# si se ingresan parametros no permitidos se informa error
		} else {

			$this->controller = 'HomeController';
			$this->method = 'errorURL';
			
			$namespace = 'App\Controllers\\'.$this->controller;
			$controller = new $namespace;
			$method = $this->method;
			$controller->$method();

		}
		
	}

}

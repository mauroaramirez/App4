<?php 

namespace App\Controllers;

use App\config\BaseController;

class MenuController extends BaseController {

	public function index() {

		$datos = array(
			[
				"nombre" => "dante",
				"apellido" => "zanor"
			],
			[
				"nombre" => "mauro",
				"apellido" => "ramirez"
			]
		);

		$this->renderView('menu/index', [
			'datos' => $datos
		]);

	}

}
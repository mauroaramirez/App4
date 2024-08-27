<?php 

namespace App\Controllers;

use App\config\BaseController;

class HomeController extends BaseController {

	public function index() {

		$this->renderView('home/index');

	}

	public function errorUrl() {

		include_once '../Views/home/errorUrl.php';
		
	}

}
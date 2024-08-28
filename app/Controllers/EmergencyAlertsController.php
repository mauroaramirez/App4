<?php

namespace App\Controllers;

use App\config\BaseController;
use App\config\MySql;
use App\Models\EmergencyAlertsModel;

class EmergencyAlertsController extends BaseController
{

	public function index()
	{

		$db = new MySql;

		$db->setQuery(EmergencyAlertsModel::$all_emergency_alerts);
		$db->setFetchAll(true);
		$db->runQuery();
		$response = $db->getResponse();

		if ($response['query']) {

			$this->renderView('EmergencyAlerts/index', [
				'emergency_alerts' => $response['rowsInSet']
			]);
		} else {
			echo "SQLSTATE: " . $response['error'][0] . " ERROR: " . $response['error'][1] . " MENSAJE: " . $response['error'][2];
		}
	}

	public function show($id)
	{

		$db = new Mysql;

		$db->setParams([$id]);
		$db->setQuery(EmergencyAlertsModel::$show_emergency_alerts);
		$db->runQuery();

		$response = $db->getResponse();

		$this->renderView('EmergencyAlerts/show', [
			'emergency_alerts' => $response['rowsInSet']
		]);
	}


	public function delete($id)
	{

		$db = new Mysql;

		if (isset($_POST['submitDeleteEmergencyAlerts'])) {

			$db->setParams([$id]);
			$db->setQuery(EmergencyAlertsModel::$delete_emergency_alerts);

			$db->runQuery();

			$response = $db->getResponse();

			if (($response['query']) && ($response['rowsAffected'] == 1)) {

				$this->redirectTo('EmergencyAlerts/');
			} else {

				$this->redirectTo('EmergencyAlerts/');
				$this->addAlert($response['error'][2]);
			}
		}
	}
}

<?php 

namespace App\Models;

class EmergencyAlertsModel {

	static public $all_emergency_alerts = '
	SELECT
		*
	FROM emergency_alerts
	';

	static public $show_emergency_alerts = '
	SELECT
		*
	FROM emergency_alerts
	WHERE emergency_alerts.id = ?
	';

	static public $delete_emergency_alerts = '
	DELETE FROM emergency_alerts WHERE emergency_alerts.id = ?
	';

}
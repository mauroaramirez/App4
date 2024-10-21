<?php

namespace Clases;

require_once 'Database.php';

use PDO;

use Clases\Database;

$conectar = new Database;

$conectar = $conectar->conectar();

class Session
{
	private $dni;
	private $pass;

	public function login()
	{
		$query = '
		SELECT CONCAT_WS(", ", people.name,people.last_name) AS "personas"
			,people.id AS "id"
			,people.email AS "email"
			,people.country AS "country"
			,people.id_status AS "id_status"
			,people.pass AS "pass"
			,roles.id AS "rol_id"
			,roles.role AS "rol"
		FROM people
			JOIN roles ON people.rol_id = roles.id
		WHERE people.dni = ?
		';
		$stmt = Database::conectar()->prepare($query);

		$stmt->bindParam(1, $this->dni);

		if ($stmt->execute()) {
			$result = ["Query Ok:", $stmt->rowCount(), $stmt->fetchAll(PDO::FETCH_ASSOC)];
			return $result;
		} else {
			return $stmt->errorInfo();
		}
	}

	public function getDni()
	{
		return $this->dni;
	}

	public function setDni($dni)
	{
		$this->dni = $dni;
	}

	public function getPass()
	{
		return $this->pass;
	}

	public function setPass($pass)
	{
		$this->pass = $pass;
	}
}

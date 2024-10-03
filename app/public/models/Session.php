<?php

namespace Clases;

require_once 'Database.php';

use PDO;

use Clases\Database;

class Session
{

	private $dni;
	private $pass;

	public function login()
	{
		$query = '
		SELECT CONCAT_WS(", ", personas.nombre,personas.apellido) AS "personas"
			,personas.id AS "id"
			,personas.email AS "email"
			,personas.pais AS "pais"
			,personas.estado AS "estado"
			,personas.pass AS "pass"
			,roles.id AS "rol_id"
			,roles.role AS "rol"
		FROM personas
			JOIN roles ON personas.rol_id = roles.id
		WHERE personas.dni = ?
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

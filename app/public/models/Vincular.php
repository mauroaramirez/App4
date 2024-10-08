<?php

namespace Clases;

require_once 'Database.php';
//require_once '../utils/utils.php';

use PDO;

use Clases\Database;

class Vincular
{

	private $people;
	private $dispositivo;


	public function getPeople()
	{
		return $this->people;
	}

	public function setPeople($people)
	{
		$this->people = trim(ucwords(strtolower($people)));
	}

	public function getDispositivo()
	{
		return $this->dispositivo;
	}
	public function setDispositivo($dispositivo)
	{
		$this->dispositivo = trim(ucwords(strtolower($dispositivo)));
	}

	public function insert()
	{
		$insert = "INSERT INTO vinculados (id_persona,id_dispositivo) VALUES (?,?)";

		$stmt = Database::conectar()->prepare($insert);
		$stmt->bindParam(1, $this->people);
		$stmt->bindParam(2, $this->dispositivo);

		if ($stmt->execute()) {
			$result = ["Query Ok:", $stmt->rowCount(), $stmt->fetchAll(PDO::FETCH_ASSOC)];
			return $stmt->errorCode();
		} else {
			$result = ["Codigo de error: ", $stmt->errorCode(), "Detalle:", $stmt->errorInfo()];
			return $result;
		}
	}

	public function selectAll()
	{

		$query = '
			SELECT CONCAT_WS(" ", people.name, people.last_name) AS "titular"
				,people.email AS email
				,people.created_at AS created_at
				,dispositivos.marca AS marca
				,dispositivos.modelo AS modelo
				,dispositivos.imei AS imei
			FROM vinculados AS vinculados
				JOIN people ON people.id = vinculados.id_persona
				JOIN dispositivos ON dispositivos.id = vinculados.id_dispositivo;
		';

		$stmt = Database::conectar()->prepare($query);

		if ($stmt->execute()) {
			$result = ["Query Ok:", $stmt->rowCount(), $stmt->fetchAll(PDO::FETCH_ASSOC)];
			return $result;
		} else {
			return $stmt->errorInfo();
		}
	}

	public function selectOne($id)
	{

		$query = '
			SELECT CONCAT_WS(" ", people.name, people.last_name) AS "titular"
				,people.email AS email
				,people.created_at AS created_at
				,dispositivos.marca AS marca
				,dispositivos.modelo AS modelo
				,dispositivos.imei AS imei
			FROM vinculados AS vinculados
				JOIN people ON people.id = vinculados.id_persona
				JOIN dispositivos ON dispositivos.id = vinculados.id_dispositivo
			WHERE people.id = ?
		';

		$stmt = Database::conectar()->prepare($query);

		$stmt->bindParam(1, $id);

		if ($stmt->execute()) {
			$result = ["Query Ok:", $stmt->rowCount(), $stmt->fetch(PDO::FETCH_ASSOC)];
			return $result;
		} else {
			return $stmt->errorInfo();
		}
	}
}

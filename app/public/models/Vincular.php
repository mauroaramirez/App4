<?php

namespace Clases;

require_once 'Database.php';

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
		$insert = "INSERT INTO linked (id_people,id_device) VALUES (?,?)";

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
				,devices.id_brand AS id_brand
				,devices.id_model AS id_model
				,devices.imei AS imei
                ,brands.description as marca
                ,models.description as modelo
			FROM linked AS vinculados
				JOIN people ON people.id = vinculados.id_people
				JOIN devices ON devices.id = vinculados.id_device
                JOIN brands on brands.id = devices.id_brand
                JOIN models on models.id = devices.id_model
			WHERE vinculados.id_status = 1 and people.id_status = 1
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
			FROM linked AS vinculados
				JOIN people ON people.id = linked.id_people
				JOIN dispositivos ON dispositivos.id = linked.id_dispositivo
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

<?php

namespace Clases;

require_once 'Database.php';
//require_once '../utils/utils.php';

use PDO;

class Dispositivos
{

	private $marca;

	private $modelo;

	private $imei;

	public function getMarcas()
	{
		return $this->marca;
	}

	public function setMarcas($marca)
	{
		$this->marca = trim(ucwords(strtolower($marca)));
	}

	public function getModelo()
	{
		return $this->modelo;
	}

	public function setModelo($modelo)
	{
		$this->modelo = trim(ucwords(strtolower($modelo)));
	}

	public function getImei()
	{
		return $this->imei;
	}

	public function setImei($imei)
	{
		$this->imei = trim(ucwords(strtolower($imei)));
	}

	public function insert()
	{
		$insert = "INSERT INTO dispositivos (marca,modelo,imei) VALUES (?,?,?)";

		$stmt = Database::conectar()->prepare($insert);
		$stmt->bindParam(1, $this->marca);
		$stmt->bindParam(2, $this->modelo);
		$stmt->bindParam(3, $this->imei);

		if ($stmt->execute()) {
			$result = ["Query Ok:", $stmt->rowCount(), $stmt->fetchAll(PDO::FETCH_ASSOC)];
			return $stmt->errorCode();
		} else {
			$result = ["Codigo de error: ", $stmt->errorCode(), "Detalle:", $stmt->errorInfo()];
			return $result;
		}
	}

	public function selectDispositivos()
	{
		$query = '
		SELECT dispositivos.id AS "id"
			,dispositivos.marca AS "marca"
			,dispositivos.modelo AS "modelo"
			,dispositivos.imei AS "imei"
		FROM dispositivos
		';
		$stmt = Database::conectar()->prepare($query);

		if ($stmt->execute()) {
			$result = ["Query Ok:", $stmt->rowCount(), $stmt->fetchAll(PDO::FETCH_ASSOC)];
			return $result;
		} else {
			return $stmt->errorInfo();
		}
	}
}

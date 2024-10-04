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
		$this->marca = trim(strtoupper($marca));
	}

	public function getModelo()
	{
		return $this->modelo;
	}

	public function setModelo($modelo)
	{
		$this->modelo = trim(strtoupper($modelo));
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

	public function selectOne($id)
	{

		$query = '
		SELECT dispositivos.id AS "id"
			,dispositivos.marca AS "marca"
			,dispositivos.modelo AS "modelo"
			,dispositivos.imei AS "imei"
		FROM dispositivos
		WHERE dispositivos.id = ?
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

	public function updateDispositivo($id)
	{
		$update = "
		UPDATE `dispositivos` SET `marca` = ?
		, `modelo` = ?
		, `imei` = ? 
		WHERE `dispositivos`.`id` = ?";

		$stmt = Database::conectar()->prepare($update);
		$stmt->bindParam(1, $this->marca);
		$stmt->bindParam(2, $this->modelo);
		$stmt->bindParam(3, $this->imei);
		$stmt->bindParam(4, $id);

		if ($stmt->execute()) {
			$result = ["Query Ok:", $stmt->rowCount(), $stmt->fetchAll(PDO::FETCH_ASSOC)];
			return $result;
		} else {
			return $stmt->errorInfo();
		}
	}

	public function deleteDispotivos($id)
	{
		$delete = "DELETE FROM `dispositivos` WHERE `id` = ?";

		$stmt = Database::conectar()->prepare($delete);
		$stmt->bindParam(1, $id);

		if ($stmt->execute()) {
			$result = ["Query Ok:", $stmt->rowCount(), $stmt->fetchAll(PDO::FETCH_ASSOC)];
			return $result;
		} else {
			return $stmt->errorInfo();
		}
	}
}

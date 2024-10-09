<?php

namespace Clases;

require_once 'Database.php';
//require_once '../utils/utils.php';

use PDO;

use Clases\Database;

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
		$insert = "INSERT INTO devices (id_brand,id_model,imei) VALUES (?,?,?)";

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
		SELECT devices.id as id
			,brands.description as marca
			,models.description as modelo
			,devices.imei as imei
		FROM `devices` as devices
			JOIN brands ON brands.id = devices.id_brand
			JOIN models ON models.id = devices.id_model
		';
		$stmt = Database::conectar()->prepare($query);

		if ($stmt->execute()) {
			$result = ["Query Ok:", $stmt->rowCount(), $stmt->fetchAll(PDO::FETCH_ASSOC)];
			return $result;
		} else {
			return $stmt->errorInfo();
		}
	}

	public function selectOneDispositivo($id)
	{
		$query = '
		SELECT devices.id as id
			,brands.description as marca
			,models.description as modelo
			,devices.imei as imei
            ,devices.id_brand as id_brand
            ,devices.id_model as id_model
		FROM `devices` as devices
			JOIN brands ON brands.id = devices.id_brand
			JOIN models ON models.id = devices.id_model
		WHERE devices.id = ?
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

	public function selectBrand()
	{
		$query = '
			SELECT brands.id as id
				,brands.description as "descripcion"
			FROM brands
		';
		$stmt = Database::conectar()->prepare($query);

		if ($stmt->execute()) {
			$result = ["Query Ok:", $stmt->rowCount(), $stmt->fetchAll(PDO::FETCH_ASSOC)];
			return $result;
		} else {
			return $stmt->errorInfo();
		}
	}

	public function selectModels()
	{
		$query = '
			SELECT models.id as id
				,models.description as "descripcion"
			FROM models
		';
		$stmt = Database::conectar()->prepare($query);

		if ($stmt->execute()) {
			$result = ["Query Ok:", $stmt->rowCount(), $stmt->fetchAll(PDO::FETCH_ASSOC)];
			return $result;
		} else {
			return $stmt->errorInfo();
		}
	}

	public function updateDispositivo($id)
	{
		$update = "
			UPDATE `devices` 
			SET `id_brand` = ?
				, `id_model` = ?
				, `imei` = ? 
			WHERE `devices`.`id` = ?";

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
		$delete = "DELETE FROM `devices` WHERE `id` = ?";

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

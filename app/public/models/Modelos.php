<?php

namespace Clases;

require_once 'Database.php';
require_once 'Marcas.php';
require_once '../utils/utils.php';

use PDO;

class Modelos
{

	private $modelo;

	private $marca;

	public function getModelo()
	{
		return $this->modelo;
	}

	public function setModelos($modelo)
	{
		$this->modelo = trim(ucwords(strtolower($modelo)));
	}

	public function getMarca()
	{
		return $this->marca;
	}

	public function setMarcas($marca)
	{
		$this->marca = trim(ucwords(strtolower($marca)));
	}

	public function selectMarcas()
	{
		$query = '
		SELECT marcas.id AS "id"
			,marcas.descripcion AS "descripcion"
		FROM marcas
		';
		$stmt = Database::conectar()->prepare($query);

		if ($stmt->execute()) {
			$result = ["Query Ok:", $stmt->rowCount(), $stmt->fetchAll(PDO::FETCH_ASSOC)];
			return $result;
		} else {
			return $stmt->errorInfo();
		}
	}

	public function selectModelos()
	{
		$query = '
		SELECT modelos.id AS "id"
			,modelos.descripcion AS "descripcion"
			,modelos.id_marca AS "id_marca"
		FROM modelos
		';
		$stmt = Database::conectar()->prepare($query);

		if ($stmt->execute()) {
			$result = ["Query Ok:", $stmt->rowCount(), $stmt->fetchAll(PDO::FETCH_ASSOC)];
			return $result;
		} else {
			return $stmt->errorInfo();
		}
	}

	public function insert()
	{
		$insert = "INSERT INTO modelos (descripcion,id_marca) VALUES (?,?)";

		$stmt = Database::conectar()->prepare($insert);

		$stmt->bindParam(1, $this->modelo);
		$stmt->bindParam(2, $this->marca);

		if ($stmt->execute()) {
			$result = ["Query Ok:", $stmt->rowCount(), $stmt->fetchAll(PDO::FETCH_ASSOC)];
			return $stmt->errorCode();
		} else {
			$result = ["Codigo de error: ", $stmt->errorCode(), "Detalle:", $stmt->errorInfo()];
			return $result;
		}
	}
}

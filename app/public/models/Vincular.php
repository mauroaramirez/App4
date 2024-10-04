<?php

namespace Clases;

require_once 'Database.php';
//require_once '../utils/utils.php';

use PDO;

use Clases\Database;

class Vincular
{

	private $persona;
	private $dispositivo;


	public function getPersona()
	{
		return $this->persona;
	}

	public function setPersona($persona)
	{
		$this->persona = trim(ucwords(strtolower($persona)));
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
		$stmt->bindParam(1, $this->persona);
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
			SELECT CONCAT_WS(" ", personas.nombre, personas.apellido) AS "titular"
				,personas.email AS email
				,personas.fecha_alta AS fecha_alta
				,dispositivos.marca AS marca
				,dispositivos.modelo AS modelo
				,dispositivos.imei AS imei
			FROM vinculados AS vinculados
				JOIN personas ON personas.id = vinculados.id_persona
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

	public function selectTipoVehiculos()
	{
		$query = '
		SELECT tipos_vehiculos.id AS "id"
			,tipos_vehiculos.descripcion AS "descripcion"
		FROM tipos_vehiculos
		';
		$stmt = Database::conectar()->prepare($query);

		if ($stmt->execute()) {
			$result = ["Query Ok:", $stmt->rowCount(), $stmt->fetchAll(PDO::FETCH_ASSOC)];
			return $result;
		} else {
			return $stmt->errorInfo();
		}
	}

	public function selectTipoCarroceria()
	{
		$query = '
		SELECT tipos_carrocerias.id AS "id"
			,tipos_carrocerias.descripcion AS "descripcion"
		FROM tipos_carrocerias
		';
		$stmt = Database::conectar()->prepare($query);

		if ($stmt->execute()) {
			$result = ["Query Ok:", $stmt->rowCount(), $stmt->fetchAll(PDO::FETCH_ASSOC)];
			return $result;
		} else {
			return $stmt->errorInfo();
		}
	}

	public function selectTipoTransmision()
	{
		$query = '
		SELECT tipos_transmisiones.id AS "id"
			,tipos_transmisiones.descripcion AS "descripcion"
		FROM tipos_transmisiones
		';
		$stmt = Database::conectar()->prepare($query);

		if ($stmt->execute()) {
			$result = ["Query Ok:", $stmt->rowCount(), $stmt->fetchAll(PDO::FETCH_ASSOC)];
			return $result;
		} else {
			return $stmt->errorInfo();
		}
	}

	public function selectTipoMotor()
	{
		$query = '
		SELECT tipos_motores.id AS "id"
			,tipos_motores.descripcion AS "descripcion"
		FROM tipos_motores
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
			SELECT CONCAT_WS(" ", personas.nombre, personas.apellido) AS "titular"
				,personas.email AS email
				,personas.fecha_alta AS fecha_alta
				,dispositivos.marca AS marca
				,dispositivos.modelo AS modelo
				,dispositivos.imei AS imei
			FROM vinculados AS vinculados
				JOIN personas ON personas.id = vinculados.id_persona
				JOIN dispositivos ON dispositivos.id = vinculados.id_dispositivo
			WHERE personas.id = ?
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

	public function update($id)
	{

		$update = "
			UPDATE autos
			JOIN marcas ON autos.id_marca = marcas.id
			JOIN modelos ON autos.id_modelo = modelos.id
			JOIN titulares ON autos.id_titular = titulares.id
			JOIN tipos_vehiculos ON autos.id_tipo_vehiculo = tipos_vehiculos.id
			JOIN tipos_carrocerias ON autos.id_tipo_carroceria = tipos_carrocerias.id
			JOIN tipos_transmisiones ON autos.id_tipo_transmision = tipos_transmisiones.id
			JOIN tipos_motores ON autos.id_tipo_motor = tipos_motores.id
			SET autos.id_marca = ?,
				autos.id_modelo = ?,
				autos.id_titular = ?,
				autos.id_tipo_vehiculo = ?,
				autos.id_tipo_carroceria = ?,
				autos.id_tipo_transmision = ?,
				autos.id_tipo_motor = ?,
				autos.peso = ?,
				autos.rodado = ?,
				autos.color = ?
			WHERE autos.id = ?;
		";

		$stmt = Database::conectar()->prepare($update);
		$stmt->bindParam(1, $this->persona);
		$stmt->bindParam(2, $this->dispositivo);
		$stmt->bindParam(11, $id);

		if ($stmt->execute()) {
			$result = ["Query Ok:", $stmt->rowCount(), $stmt->fetchAll(PDO::FETCH_ASSOC)];
			return $result;
		} else {
			return $stmt->errorInfo();
		}
	}

	public function delete($id)
	{
		$delete = "DELETE FROM `autos` WHERE `id` = ?";

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

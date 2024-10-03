<?php

namespace Clases;

//require_once 'Personas.php';
require_once 'Database.php';
//require_once '../utils/utils.php';

use PDO;
//use Clases\Personas;
use Clases\Database;

class Personas
{
	protected $nombre;
	protected $apellido;
	protected $dni;
	protected $sexo = "X";
	//
	private $email;
	private $direccion;
	private $pais;

	private $pass;

	public function getNombre()
	{
		return $this->nombre;
	}
	public function setNombre($nombre)
	{
		$this->nombre = trim(ucwords(strtolower($nombre)));
	}

	public function getApellido()
	{
		return $this->apellido;
	}
	public function setApellido($apellido)
	{
		$this->apellido = trim(ucwords(strtolower($apellido)));
	}

	public function getDni()
	{
		return $this->dni;
	}
	public function setDni($dni)
	{
		$this->dni = $dni;
	}

	public function getSexo()
	{
		return $this->sexo;
	}
	public function setSexo($sexo)
	{
		$this->sexo = $sexo;
	}
	//
	public function getEmail()
	{
		return $this->email;
	}

	public function setEmail($email)
	{
		$this->email = strtolower(trim($email));
	}

	public function getDireccion()
	{
		return $this->direccion;
	}

	public function setDireccion($direccion)
	{
		$this->direccion = trim(ucwords(strtolower($direccion)));
	}

	public function getPais()
	{
		return $this->pais;
	}

	public function setPais($pais)
	{
		$this->pais = trim(ucwords(strtolower($pais)));
	}

	public function getPass()
	{
		return $this->pass;
	}

	public function setPass($pass)
	{
		$this->pass = password_hash($pass, PASSWORD_DEFAULT);
	}

	public function insert()
	{
		$insert = "INSERT INTO personas (nombre,apellido,dni,sexo,email,pass,direccion,pais) VALUES (?,?,?,?,?,?,?,?)";

		$stmt = Database::conectar()->prepare($insert);
		$stmt->bindParam(1, $this->nombre);
		$stmt->bindParam(2, $this->apellido);
		$stmt->bindParam(3, $this->dni);
		$stmt->bindParam(4, $this->sexo);
		$stmt->bindParam(5, $this->email);
		$stmt->bindParam(6, $this->pass);
		$stmt->bindParam(7, $this->direccion);
		$stmt->bindParam(8, $this->pais);

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
		SELECT personas.id AS "id"
			,CONCAT_WS(", ",personas.nombre, personas.apellido) AS "personas"
    		,personas.dni AS "dni"
    		,personas.sexo AS "sexo"
    		,personas.email AS "email"
    		,personas.direccion AS "direccion"
    		,personas.pais AS "pais"
		FROM personas
		WHERE personas.rol_id != 1
		';

		$stmt = Database::conectar()->prepare($query);

		if ($stmt->execute()) {
			$result = ["Query Ok:", $stmt->rowCount(), $stmt->fetchAll(PDO::FETCH_ASSOC)];
			return $result;
		} else {
			return $stmt->errorInfo();
		}
	}

	public function selectPersonas()
	{

		$query = '
		SELECT personas.id AS "id"
			,CONCAT_WS(", ",personas.nombre, personas.apellido) AS "personas"
		FROM personas
		WHERE personas.rol_id != 1
		';

		$stmt = Database::conectar()->prepare($query);

		if ($stmt->execute()) {
			$result = ["Query Ok:", $stmt->rowCount(), $stmt->fetchAll(PDO::FETCH_ASSOC)];
			return $result;
		} else {
			return $stmt->errorInfo();
		}
	}

	public function update($id)
	{
		$update = "
		UPDATE `personas` SET `nombre`= ?	
    		,`apellido`= ?
    		,`dni`= ?
    		,`sexo`= ?
    		,`email`= ?
    		,`direccion`= ?
    		,`pais`= ?
		WHERE `id` = ?
		";

		$stmt = Database::conectar()->prepare($update);
		$stmt->bindParam(1, $this->nombre);
		$stmt->bindParam(2, $this->apellido);
		$stmt->bindParam(3, $this->dni);
		$stmt->bindParam(4, $this->sexo);
		$stmt->bindParam(5, $this->email);
		$stmt->bindParam(6, $this->direccion);
		$stmt->bindParam(7, $this->pais);
		$stmt->bindParam(8, $id);

		if ($stmt->execute()) {
			$result = ["Query Ok:", $stmt->rowCount(), $stmt->fetchAll(PDO::FETCH_ASSOC)];
			return $result;
		} else {
			return $stmt->errorInfo();
		}
	}

	public function delete($id)
	{
		$delete = "DELETE FROM `personas` WHERE `id` = ?";

		$stmt = Database::conectar()->prepare($delete);
		$stmt->bindParam(1, $id);

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
		SELECT CONCAT_WS(", ",personas.nombre, personas.apellido) AS "titular"
    		,personas.dni AS "dni"
    		,personas.sexo AS "sexo"
    		,personas.email AS "email"
    		,personas.direccion AS "direccion"
    		,personas.pais AS "pais"
		FROM personas
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
}

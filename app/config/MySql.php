<?php

namespace App\config;

use PDO;

class MySql extends PDO
{

	private $dns;
	private $user;
	private $pass;
	private $stmt;
	private $query;
	private $params = null;
	private $assoc = true;
	private $fetchAll = false;
	private $response;

	public function __construct()
	{
		$connection = explode(",", $_ENV['DATABASE']);
		$this->dns = $connection[0];
		$this->user = $connection[1];
		$this->pass = $connection[2];
	}

	/**
	 * @method mySqlConnect() establece la conexion con la base y retorna el objeto PDO
	 */
	private function mySqlConnect()
	{

		$link = new PDO($this->dns, $this->user, $this->pass);
		$link->exec("set names utf8");
		return $link;
	}

	/**
	 * @method testConnect() si se obtiene PDO Object() la conexion fue exitosa
	 */
	public function testConnect()
	{

		$this->stmt = self::mySqlConnect();
		echo '<pre>';
		print_r($this->stmt);
		echo '</pre>';
	}

	/**
	 * @return string
	 */
	public function getQuery()
	{
		return $this->query;
	}

	/**
	 * @method setQuery($query) recibe un string con la query a ejecutar
	 */
	public function setQuery($query)
	{

		if (!is_string($query)) {
			throw new Exception("setQuery espera un parametro del tipo string y se proporciono " . gettype($query));
		}
		try {
			$this->query = $query;
		} catch (Exception $e) {
			$e->getMessage();
		}
	}

	/**
	 * @method obtener los parametros seteados
	 * @return array
	 */
	public function getParams(): array
	{
		return $this->params;
	}

	/**
	 * @method debe ser un array con los parametros que se utilizaran
	 * 	en la query
	 */
	public function setParams($params)
	{

		if (!is_array($params)) {
			throw new Exception("setParams espera un parametro del tipo array() y se proporciono " . gettype($params));
		}
		try {
			$this->params = $params;
		} catch (Exception $e) {
			$e->getMessage();
		}
	}

	/**
	 * @return boolean
	 */
	public function getAssoc()
	{
		return $this->assoc;
	}

	/**
	 * @method recibe boolean, por default es true, para que los
	 * 		datos devueltos sean un array con indices asociativos 
	 */
	public function setAssoc($assoc)
	{

		if (!is_bool($assoc)) {
			throw new Exception("setAssoc espera un parametro true o false y se proporciono " . gettype($assoc));
		}
		try {
			$this->assoc = $assoc;
		} catch (Exception $e) {
			$e->getMessage();
		}
	}

	/**
	 * @return boolean
	 */
	public function getFetchAll()
	{
		return $this->fetchAll;
	}

	/**
	 * @method recibe boolean, por default es false, sirve para activar o desactivar
	 * 		el metodo fetchAll() de PDO para devolver los datos
	 */
	public function setFetchAll($fetchAll)
	{

		if (!is_bool($fetchAll)) {
			throw new Exception("setFetchAll espera un parametro true o false y se proporciono " . gettype($assoc));
		}
		try {
			$this->fetchAll = $fetchAll;
		} catch (Exception $e) {
			$e->getMessage();
		}
	}

	/**
	 * @method runQuery() ejecuta la query que se asigno
	 */
	public function runQuery()
	{

		$this->stmt = self::mySqlConnect()->prepare($this->query);

		if ($this->params != null) {
			for ($i = 0; $i < count($this->params); $i++) {
				if (is_float($this->params[$i])) {
					$this->stmt->bindParam($i + 1, $this->params[$i]);
				} elseif (is_integer($this->params[$i])) {
					$this->stmt->bindParam($i + 1, $this->params[$i], PDO::PARAM_INT);
				} elseif (is_string($this->params[$i])) {
					$this->stmt->bindParam($i + 1, $this->params[$i], PDO::PARAM_STR);
				}
			}
		}

		if ($this->stmt->execute()) {

			if ($this->assoc) {

				if ($this->fetchAll) {
					$this->response = [
						'query' => true,
						'rowsAffected' => $this->stmt->rowCount(),
						'rowsInSet' => $this->stmt->fetchAll(PDO::FETCH_ASSOC)
					];
				} else {
					$this->response = [
						'query' => true,
						'rowsAffected' => $this->stmt->rowCount(),
						'rowsInSet' => $this->stmt->fetch(PDO::FETCH_ASSOC)
					];
				}
			} else {

				if ($this->fetchAll) {
					$this->response = [
						'query' => true,
						'rowsAffected' => $this->stmt->rowCount(),
						'rowsInSet' => $this->stmt->fetchAll(PDO::FETCH_NUM)
					];
				} else {
					$this->response = [
						'query' => true,
						'rowsAffected' => $this->stmt->rowCount(),
						'rowsInSet' => $this->stmt->fetch(PDO::FETCH_NUM)
					];
				}
			}
		} else {

			$this->response = [
				'query' => false,
				'error' => $this->stmt->errorInfo()
			];
		}

		$this->stmt = null;
	}

	/**
	 * @method devuelve el array con la respuesta
	 */
	public function getResponse(): array
	{
		return $this->response;
	}
}

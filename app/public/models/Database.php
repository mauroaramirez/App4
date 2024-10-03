<?php

namespace Clases;

use PDO;

class Database
{

	public static function conectar()
	{

		$link = new PDO("mysql:host=sql-app4-r; dbname=autos", "root", "root");
		$link->exec("set names utf8");
		return $link;
	}
}

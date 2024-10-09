<?php

namespace Clases;

use PDO;

class Database
{

	public static function conectar()
	{

		$link = new PDO("mysql:host=sql-app4-r; dbname=app4", "root", "root");
		$link->exec("set names utf8");
		return $link;
	}
}

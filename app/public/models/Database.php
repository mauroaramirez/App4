<?php

namespace Clases;

use PDO;

class Database
{
    public static function conectar()
    {
        $databaseString = getenv('DATABASE') ?: $_ENV['DATABASE'];

        // Remover las comillas dobles (si están presentes)
        $databaseString = trim($databaseString, '"');

        // Extraer los valores
        preg_match('/mysql:host=([^;]+);dbname=([^,]+),([^,]+),(.+)/', $databaseString, $matches);

        // Validar si se obtuvieron los valores correctamente
        if (count($matches) === 5) {
            $host = $matches[1];      // sql-app4
            $dbname = $matches[2];    // app4
            $username = $matches[3];  // root
            $password = $matches[4];  // root

            // Crear la conexión PDO usando las variables extraídas
            $link = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
            $link->exec("set names utf8");

            return $link;
        } else {
            throw new \Exception("Error: formato de la variable DATABASE incorrecto.");
        }
    }
}
<?php

namespace App\Models;

use PDO;
use PDOException;

class Model
{
    public static PDO $connection;

    public function __construct()
    {
        $databaseConfigs = getConfigFile('database');

        $dbName = $databaseConfigs ['db_name'];

        $password = $databaseConfigs['password'];

        $host = $databaseConfigs['host'];

        $username = $databaseConfigs['username'];

        $dsn = "mysql:host=$host;dbname=$dbName";

        self::$connection = new PDO($dsn, $username, $password, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ],);

    }
}
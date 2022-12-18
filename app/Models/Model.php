<?php

namespace App\Models;

use PDO;
use PDOException;

abstract class Model
{
    public static PDO $connection;

    public function __construct()
    {
        self::setConnection();
    }

    abstract public static function getTableName(): string;

    public static function find(int $id)
    {
        self::setConnection();

        $tableName = static::getTableName();

        $query = "select * from $tableName where id=? limit 1";

        $stmt = self::$connection->prepare($query);

        $stmt->bindValue(1, $id);

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function all()
    {
        self::setConnection();

        $tableName = static::getTableName();

        $query = "select * from $tableName";

        $stmt = self::$connection->prepare($query);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function setConnection(): void
    {
        $databaseConfigs = getConfigFile('database');

        $dbName = $databaseConfigs ['db_name'];

        $password = $databaseConfigs['password'];

        $host = $databaseConfigs['host'];

        $username = $databaseConfigs['username'];

        $dsn = "mysql:host=$host;dbname=$dbName";

        self::$connection = new PDO($dsn, $username, $password);

        self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        /**
         * for showing column names for any row we set fetch mode on assoc(in other fetch types we just get values per rows)
         */
        self::$connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        self::$connection->exec('SET CHARACTER SET UTF8');
    }

    public static function delete($id): void
    {
        self::setConnection();

        $table = static::getTableName();

        $query = "delete from $table where id=?";

        $stmt = self::$connection->prepare($query);

        $stmt->bindValue(1, $id);

        $stmt->execute();
    }

    public static function create($values)
    {
        self::setConnection();

        $table = static::getTableName();

        $fields = join(',', array_keys($values));

        $values = array_values($values);

        $valueBindValue = "";
        foreach (range(1, count($values)) as $key => $value) {
            $key + 1 !== count($values) ?
                $valueBindValue .= "?," : $valueBindValue .= "?";
        }


        $query = "insert into $table ($fields) values($valueBindValue)";


        $stmt = self::$connection->prepare($query);

        foreach ($values as $key => $value) {
            $stmt->bindValue($key + 1, $value);
        }

        $stmt->execute();
    }
}
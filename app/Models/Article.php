<?php

namespace App\Models;

use PDO;

class Article extends Model
{

    public static function getTableName(): string
    {
        return 'articles';
    }

    public function all(): false|array
    {
        $table = self::getTableName();

        $query = "select * from $table";

        $stmt = $this->connection->prepare($query);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function categories($categoryId)
    {
        $categoryTable = ArticleCategory::getTableName();

        $query = "select * from $categoryTable where id=?";

        $stmt=$this->connection->prepare($query);

        $stmt->bindValue(1,$categoryId);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
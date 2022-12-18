<?php

namespace App\Models;

use PDO;

class Article extends Model
{

    public static function getTableName(): string
    {
        return 'articles';
    }

    public function categories($categoryId)
    {
        $categoryTable = ArticleCategory::getTableName();

        $query = "select * from $categoryTable where id=?";

        $stmt = $this->connection->prepare($query);

        $stmt->bindValue(1, $categoryId);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


}
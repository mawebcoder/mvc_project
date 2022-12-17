<?php

namespace App\Models;

use App\Models\Model;
use PDO;

class ArticleCategory extends Model
{


    public static function getTableName(): string
    {
        return 'article_categories';
    }


}
<?php

namespace APP\Http\Controllers;

use App\Models\Article as ArticleModel;
use Exception;

class article
{

    /**
     * @throws \Exception
     */
    public function store()
    {
        $data = $this->getDataFromRequest();

        ArticleModel::create([
            'name' => $data['name'],
            'category_id' => $data['category_id']
        ]);

        return back();
    }

    public function getDataFromRequest(): array
    {
        return [
            'name' => $_POST['name'] ?? null,
            'category_id' => $_POST['category_id'] ?? null
        ];
    }

    /**
     * @throws Exception
     */
    public function create(): void
    {
        view('article.create');
    }
}
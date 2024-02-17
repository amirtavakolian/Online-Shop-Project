<?php

namespace Modules\Category\App\Repositories;

use Modules\Category\App\Models\Category;
use Modules\Category\App\Repositories\Contract\iCategoryRepo;

class CategoryRepo implements iCategoryRepo
{

    public function all()
    {
        return Category::all();
    }

    public function store($data)
    {
        Category::query()->create($data);
    }
}

<?php

namespace Modules\Blog\App\Repositories;

use Modules\Blog\App\Models\Category;

class CategoriesRepo implements iCategoriesRepo
{
    public function all()
    {
        return Category::all();
    }
}

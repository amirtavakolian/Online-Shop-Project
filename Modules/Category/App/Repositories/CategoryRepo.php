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

    public function store(array $data)
    {
        Category::query()->create($data);
    }

    public function count()
    {
        return $this->all()->count();
    }

    public function parents()
    {
        return Category::query()->where('parent_id', null)->get();
    }

    public function update(Category $category, $data)
    {
        return $category->update($data);
    }
}

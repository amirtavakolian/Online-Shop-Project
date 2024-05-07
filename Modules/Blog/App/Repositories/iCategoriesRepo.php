<?php

namespace Modules\Blog\App\Repositories;

use Modules\Blog\App\Models\Category;

interface iCategoriesRepo
{

    public function all();

    public function store(array $categoryData);

    public function update(array $categoryData, Category $category);

    public function delete(Category $category);
}

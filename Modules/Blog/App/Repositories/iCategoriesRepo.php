<?php

namespace Modules\Blog\App\Repositories;

interface iCategoriesRepo
{

    public function all();

    public function store(array $categoryData);
}

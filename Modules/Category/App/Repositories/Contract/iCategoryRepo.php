<?php

namespace Modules\Category\App\Repositories\Contract;

use Modules\Category\App\Models\Category;

interface iCategoryRepo
{
    public function all();

    public function store(array $data);

    public function count();

    public function parents();

    public function update(Category $category, array $data);
}

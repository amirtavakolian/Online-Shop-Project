<?php

namespace Modules\Category\App\Repositories\Contract;

interface iCategoryRepo
{
    public function all();

    public function store(array $data);

    public function count();
}

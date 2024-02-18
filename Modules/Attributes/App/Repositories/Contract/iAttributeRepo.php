<?php

namespace Modules\Attributes\App\Repositories\Contract;


use Modules\Attributes\App\Models\Attribute;
use Modules\Category\App\Models\Category;

interface iAttributeRepo
{
    public function all();

    public function count();

    public function create(array $data);

    public function update(array $data, Attribute $attribute);
}

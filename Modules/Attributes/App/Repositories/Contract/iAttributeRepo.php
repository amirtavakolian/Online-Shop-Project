<?php

namespace Modules\Attributes\App\Repositories\Contract;

<<<<<<< HEAD
=======
use Modules\Attributes\App\Models\Attribute;
>>>>>>> feature/AttributeModule
use Modules\Category\App\Models\Category;

interface iAttributeRepo
{
    public function all();
<<<<<<< HEAD
    public function count();
=======

    public function count();

    public function create(array $data);

    public function update(array $data, Attribute $attribute);
>>>>>>> feature/AttributeModule
}

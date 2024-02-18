<?php

namespace Modules\Tags\App\Repositories\Contract;


use Modules\Attributes\App\Models\Attribute;
use Modules\Category\App\Models\Category;

interface iTagRepo
{
    public function all();

    public function count();


}

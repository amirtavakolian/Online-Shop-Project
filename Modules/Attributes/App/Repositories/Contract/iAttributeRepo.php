<?php

namespace Modules\Attributes\App\Repositories\Contract;

use Modules\Category\App\Models\Category;

interface iAttributeRepo
{
    public function all();
    public function count();
}

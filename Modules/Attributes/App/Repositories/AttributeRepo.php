<?php

namespace Modules\Attributes\App\Repositories;

use Modules\Attributes\App\Models\Attribute;
use Modules\Attributes\App\Repositories\Contract\iAttributeRepo;

class AttributeRepo implements iAttributeRepo
{

    public function all()
    {
        return Attribute::all();
    }

    public function count()
    {
        return $this->all()->count();
    }
}

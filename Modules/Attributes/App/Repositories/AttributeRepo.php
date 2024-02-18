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

    public function create(array $data)
    {
        Attribute::query()->create($data);
    }

    public function update(array $data, Attribute $attribute)
    {
        $attribute->update($data);
    }

    public function delete(Attribute $attribute)
    {
        $attribute->delete();
    }
}

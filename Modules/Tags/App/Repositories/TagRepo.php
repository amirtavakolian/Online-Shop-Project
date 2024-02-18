<?php

namespace Modules\Tags\App\Repositories;

use Modules\Tags\App\Models\Tag;
use Modules\Tags\App\Repositories\Contract\iTagRepo;

class TagRepo implements iTagRepo
{

    public function all()
    {
        return Tag::all();
    }

    public function count()
    {
        return $this->all()->count();
    }


}

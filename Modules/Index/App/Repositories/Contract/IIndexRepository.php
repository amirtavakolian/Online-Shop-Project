<?php

namespace Modules\Index\App\Repositories\Contract;


use Modules\Banner\App\Models\Banner;

interface IIndexRepository
{
    public function banners();

    public function products();
}

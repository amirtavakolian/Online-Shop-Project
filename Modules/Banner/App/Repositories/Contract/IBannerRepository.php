<?php

namespace Modules\Banner\App\Repositories\Contract;


interface IBannerRepository
{
    public function store(array $productData);

    public function all();
}

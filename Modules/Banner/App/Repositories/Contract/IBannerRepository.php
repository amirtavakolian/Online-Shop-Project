<?php

namespace Modules\Banner\App\Repositories\Contract;


use Modules\Banner\App\Models\Banner;

interface IBannerRepository
{
    public function store(array $bannerData);

    public function all();

    public function update(array $bannerData, Banner $banner);
}

<?php

namespace Modules\Banner\App\Repositories;

use Modules\Banner\App\Models\Banner;
use Modules\Banner\App\Repositories\Contract\IBannerRepository;

class BannerRepository implements IBannerRepository
{

    public function store(array $data)
    {
        Banner::query()->create($data);
    }

    public function all()
    {
        return Banner::all();
    }

    public function update(array $data, Banner $banner)
    {
        $banner->update($data);
    }
}

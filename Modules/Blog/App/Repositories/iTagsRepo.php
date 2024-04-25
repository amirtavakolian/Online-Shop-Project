<?php

namespace Modules\Blog\App\Repositories;

interface iTagsRepo
{
    public function all();

    public function store(array $tagData);
}

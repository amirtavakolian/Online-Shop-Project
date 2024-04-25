<?php

namespace Modules\Blog\App\Repositories;

use Modules\Blog\App\Models\Tag;

interface iTagsRepo
{
    public function all();

    public function store(array $tagData);

    public function update(array $tagData, Tag $tag);
}

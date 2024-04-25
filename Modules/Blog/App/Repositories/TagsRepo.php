<?php

namespace Modules\Blog\App\Repositories;

use Modules\Blog\App\Models\Tag;

class TagsRepo implements iTagsRepo
{

    public function all()
    {
        return Tag::all();
    }

    public function store(array $tagData)
    {
        Tag::query()->create($tagData);
    }

    public function update(array $tagData, Tag $tag)
    {
        $tag->update($tagData);
    }
}

<?php

namespace Modules\Blog\App\Repositories;

interface iPostsRepo
{

    public function all();

    public function create(array $postCredentials);
}

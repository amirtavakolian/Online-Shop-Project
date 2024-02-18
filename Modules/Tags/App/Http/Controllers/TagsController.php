<?php

namespace Modules\Tags\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Tags\App\Repositories\Contract\iTagRepo;


class TagsController extends Controller
{

    public function __construct(private iTagRepo $tagRepo)
    {
    }

    public function index()
    {
        $tags = $this->tagRepo->all();
        return view('tags::index', compact('tags'));
    }
}

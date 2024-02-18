<?php

namespace Modules\Tags\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Modules\Tags\App\Http\Requests\StoreTagRequest;
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

    public function create()
    {
        return view('tags::create');
    }

    public function store(StoreTagRequest $request)
    {
        try {
            $this->tagRepo->store($request->validated());
        } catch (Exception $e) {
            Log::info($e->getMessage());
            return redirect()->back()->with('failed', 'مشکلی پیش آمده', 500);
        }
        return redirect()->route('tags.index')->with('success', 'تگ با موفقیت ساخته شد');
    }
}

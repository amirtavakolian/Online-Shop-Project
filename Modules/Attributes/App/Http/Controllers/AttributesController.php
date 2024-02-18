<?php

namespace Modules\Attributes\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Attributes\App\Repositories\Contract\iAttributeRepo;

class AttributesController extends Controller
{

    public function __construct(private iAttributeRepo $attributeRepo)
    {
    }

    public function index()
    {
        $attributes = $this->attributeRepo->all();
        $attributesCount = $this->attributeRepo->count();
        return view('attributes::index', compact('attributesCount', 'attributes'));
    }
}


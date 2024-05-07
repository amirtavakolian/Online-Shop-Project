<?php

namespace Modules\Blog\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PostCalculateController extends Controller
{

    public function __invoke(Request $request)
    {
        $s1 = array_map('trim', explode(' ', $request->post('text')));
        $s2 = array_filter($s1, function($value) { return $value !== ''; });
        return count($s2) / 60;
    }
}

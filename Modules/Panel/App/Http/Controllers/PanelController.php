<?php

namespace Modules\Panel\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class PanelController extends Controller
{

    public function index()
    {
        return view('panel::index');
    }

}

<?php

namespace Modules\Coworkers\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Coworkers\App\Models\Department;

class DepartmentsController extends Controller
{

    public function index()
    {
        $coworkers = Department::all();
        return view('ticket::department.index', compact('coworkers'));
    }
}

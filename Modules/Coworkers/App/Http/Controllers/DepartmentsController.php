<?php

namespace Modules\Coworkers\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Coworkers\App\Http\Requests\StoreDepartmentRequest;
use Modules\Coworkers\App\Models\Coworker;
use Modules\Coworkers\App\Models\Department;

class DepartmentsController extends Controller
{

    public function index()
    {
        $departments = Department::all();
        return view('coworkers::department.index', compact('departments'));
    }

    public function create()
    {
        $coworkers = Coworker::all();
        return view('coworkers::department.create', compact('coworkers'));
    }

    public function store(StoreDepartmentRequest $request)
    {
        Department::query()->create($request->all());
        return redirect()->back()->with('success', 'دپارتمان با موفقیت ساخته شد');
    }
}

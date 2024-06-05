<?php

namespace Modules\Coworkers\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Modules\Coworkers\App\Http\Requests\StoreCoworkerRequest;
use Modules\Coworkers\App\Models\Coworker;
use Modules\Coworkers\App\Models\Department;

class CoworkersController extends Controller
{

    public function index()
    {
        $coworkers = Coworker::all();
        return view('coworkers::coworkers.index', compact('coworkers'));
    }

    public function create()
    {
        $departments = Department::all();
        return view('coworkers::coworkers.create', compact('departments'));
    }

    public function store(StoreCoworkerRequest $request)
    {
        $coworkerData = $request->validated();
        $coworkerData['password'] = Hash::make($request->input('password'));
        Coworker::query()->create($coworkerData);
        return redirect()->back()->with('success', 'کارمند با موفقیت ساخته شد');
    }
}


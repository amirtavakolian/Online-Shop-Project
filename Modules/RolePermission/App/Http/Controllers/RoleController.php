<?php

namespace Modules\RolePermission\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\RolePermission\App\Http\Requests\StoreRoleRequest;
use Modules\RolePermission\App\Models\Permission;
use Modules\RolePermission\App\Models\Role;

class RoleController extends Controller
{

    public function index()
    {
        $roles = Role::all()->load('permissions');
        return view('rolepermission::roles.index', compact('roles'));
    }

    public function create()
    {
        $permissions = Permission::all();
        return view('rolepermission::roles.create', compact('permissions'));
    }

    public function store(StoreRoleRequest $request)
    {
        $role = Role::query()->create($request->validated());
        $role->permissions()->attach($request->permissions);
        return redirect()->route('roles.create')->with('success', 'نقش کاربری با موفقیت ایجاد شد');
    }
}

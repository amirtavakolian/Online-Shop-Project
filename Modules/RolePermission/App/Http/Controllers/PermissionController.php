<?php

namespace Modules\RolePermission\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\RolePermission\App\Http\Requests\StorePermissionRequest;
use Modules\RolePermission\App\Models\Permission;

class PermissionController extends Controller
{

    public function create()
    {
        return view('rolepermission::permissions.create');
    }

    public function store(StorePermissionRequest $request)
    {
        Permission::query()->create($request->validated());
        return redirect()->route('permissions.create')->with('success', 'سطح دسترسی با موفقیت ایجاد شد');
    }
}

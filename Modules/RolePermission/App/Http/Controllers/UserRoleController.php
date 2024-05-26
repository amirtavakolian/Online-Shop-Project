<?php

namespace Modules\RolePermission\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\RolePermission\App\Http\Requests\StoreRoleRequest;
use Modules\RolePermission\App\Http\Requests\StoreUserRoleRequest;
use Modules\RolePermission\App\Models\Permission;
use Modules\RolePermission\App\Models\Role;
use Modules\RolePermission\App\Models\User;

class UserRoleController extends Controller
{

    public function create()
    {
        $users = User::all();
        $roles = Role::all();
        return view('rolepermission::user-role.create', compact('users', 'roles'));
    }

    public function store(StoreUserRoleRequest $request)
    {
        $user = User::query()->where('id', $request->input('user_id'))->first();
        $user->roles()->attach($request->input('roles_id'));
        return redirect()->route('user-roles.index')->with('success', 'نقش کاربری با موفقیت ایجاد شد');
    }
}

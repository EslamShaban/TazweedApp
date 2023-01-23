<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\RoleRepository;
use App\Models\Role;
use App\Http\Requests\Admin\RolesRequest;
class RoleController extends Controller
{
    private $roleRepository;
    
    public function __construct(RoleRepository $role)
    {
        $this->middleware('permission:roles-read')->only(['index']);
        $this->middleware('permission:roles-create')->only(['create', 'store']);
        $this->middleware('permission:roles-update')->only(['edit', 'update']);
        $this->middleware('permission:roles-delete')->only(['destroy']);

        $this->roleRepository = $role;
    }

    public function index()
    {
        
        $roles = Role::Roles()->get();

        return view('admin.roles.index', compact('roles'));

    }

    public function create()
    {
        return view('admin.roles.create')->with('title', __('admin.add_role'));
    }

    public function store(RolesRequest $request)
    {

        $role = $this->roleRepository->create($request->only(['name']));
        $role->attachPermissions($request->permissions);

        return redirect(aurl('roles'))->with('success', 'تم إضافة الحقل بنجاح');
    }

    public function edit($id)
    {
        $role = $this->roleRepository->find($id);

        return view('admin.roles.edit', compact('role'));
    }

    public function update(RolesRequest $request, Role $role)
    {

        $this->roleRepository->update($request->only(['name']), $role->id);

        $role->syncPermissions($request->permissions);

        return redirect(aurl('roles'))->with('success', 'تم تعديل الحقل بنجاح');

    }


    public function destroy($id)
    {
        $this->roleRepository->delete($id);

        return redirect(aurl('roles'))->with('success', 'تم حذف الحقل بنجاح');
    }
}

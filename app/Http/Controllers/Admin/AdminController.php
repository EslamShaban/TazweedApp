<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Repositories\UserRepository;
use App\Repositories\RoleRepository;
use App\Http\Requests\Admin\AdminRequest;
use App\Models\User;
use App\Models\Role;

class AdminController extends Controller
{

    private $userRepository, $roleRepository;
    
    public function __construct(UserRepository $admin, RoleRepository $role)
    {
        $this->middleware('permission:admins-read')->only(['index']);
        $this->middleware('permission:admins-create')->only(['create', 'store']);
        $this->middleware('permission:admins-update')->only(['edit', 'update']);
        $this->middleware('permission:admins-delete')->only(['destroy']);

        $this->userRepository = $admin;
        $this->roleRepository = $role;

    }

    public function index()
    {
        $admins = $this->userRepository->getUserBaseRole(['admin']);
        
        return view('admin.admins.index', compact('admins'));
    }

    public function create()
    {
        $roles = Role::Roles()->get();
        return view('admin.admins.create', compact('roles'));
    }


    public function store(AdminRequest $request)
    {

        try {

            DB::beginTransaction();
            
            $data = $request->except('_token', '_method');

            $data['password'] = bcrypt($request->password);

            $admin = $this->userRepository->create($data);

            $admin->attachRoles(['admin', $request->role_id]);

            if($request->has('image')){
                $this->UploadAsset(['asset'=>$request->image, 'path_to_save'=>'assets/uploads/users'], $admin);
            }
            
            DB::commit();

            return redirect(aurl('admins'))->with('success', 'تم إضافة الحقل بنجاح');

        } catch (\Throwable $th) {
           
            DB::rollBack();

            throw $th;

            return redirect(aurl('admins'))->with('error', 'حدث خطأ ما');

        }
    
}


    public function edit($id)
    {
        $admin = $this->userRepository->find($id);
        $roles = Role::Roles()->get();

        return view('admin.admins.edit', compact('admin','roles'));
    }

    public function update(AdminRequest $request, User $admin)
    {
        try {

            DB::beginTransaction();

            $data = $request->except('_token', '_method', 'password');

            if(request()->has('password') && $request->password != null){
                $data['password'] = bcrypt($request->password);
            }

            $this->userRepository->update($data, $admin->id);
            $admin->syncRoles(['admin', $request->role_id]);

            if($request->has('image')){

                $this->DeleteAsset($admin);
                $this->UploadAsset(['asset'=>$request->image, 'path_to_save'=>'assets/uploads/users'], $admin);
            }

            DB::commit();

            return redirect(aurl('admins'))->with('success', 'تم تعديل الحقل بنجاح');

        } catch (\Throwable $th) {
           
            DB::rollBack();
    
            throw $th;
        
            return redirect(aurl('admins'))->with('error', 'حدث خطأ ما');
        
        }
    }


    public function destroy(User $admin)
    {


        try {

            DB::beginTransaction();

            $this->DeleteAsset($admin);
            $this->userRepository->delete($admin->id);
            
            DB::commit();
            
            return redirect(aurl('admins'))->with('success', 'تم حذف الحقل بنجاح');

        } catch (\Throwable $th) {
           
            DB::rollBack();
    
            throw $th;
                
            return redirect(aurl('admins'))->with('error', 'حدث خطأ ما');
    
        }
    }

}

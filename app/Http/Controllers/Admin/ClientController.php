<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Repositories\UserRepository;
use App\Http\Requests\Admin\ClientRequest;
use App\Models\User;
class ClientController extends Controller
{

    private $userRepository;
    
    public function __construct(UserRepository $client)
    {
        $this->middleware('permission:clients-read')->only(['index']);
        $this->middleware('permission:clients-create')->only(['create', 'store']);
        $this->middleware('permission:clients-update')->only(['edit', 'update']);
        $this->middleware('permission:clients-delete')->only(['destroy']);

        $this->userRepository = $client;

    }

    public function index()
    {
        $clients = $this->userRepository->getUserBaseRole(['client']);
        
        return view('admin.clients.index', compact('clients'));
    }

    public function create()
    {
        return view('admin.clients.create');
    }


    public function store(ClientRequest $request)
    {
        try {

            DB::beginTransaction();
            
            $data = $request->except('_token', '_method');

            $data['password'] = bcrypt($request->password);

            $client = $this->userRepository->create($data);

            $client->attachRoles(['client']);

            if($request->has('image')){

                $this->UploadAsset(['asset'=>$request->image, 'path_to_save'=>'assets/uploads/users'], $client);

            }
            
            DB::commit();

            return redirect(aurl('clients'))->with('success', 'تم إضافة الحقل بنجاح');

    
        } catch (\Throwable $th) {
           
        DB::rollBack();

        throw $th;

        return redirect(aurl('clients'))->with('error', 'حدث خطأ ما');
    
     }
    
 }


    public function edit($id)
    {
        $client = $this->userRepository->find($id);

        return view('admin.clients.edit', compact('client'));
    }

    public function update(ClientRequest $request, User $client)
    {
        try {

            DB::beginTransaction();

            $data = $request->except('_token', '_method','password');

            if(request()->has('password') && $request->password != null){
                $data['password'] = bcrypt($request->password);
            }

            $this->userRepository->update($data, $client->id);

            if($request->has('image')){

                $this->DeleteAsset($client);
                $this->UploadAsset(['asset'=>$request->image, 'path_to_save'=>'assets/uploads/users'], $client);
            }

            DB::commit();

            return redirect(aurl('clients'))->with('success', 'تم تعديل الحقل بنجاح');

        } catch (\Throwable $th) {
           
            DB::rollBack();
    
            throw $th;
        
            return redirect(aurl('clients'))->with('error', 'حدث خطأ ما');
    
        }
    }


    public function destroy(User $client)
    {


        try {

            DB::beginTransaction();

            $this->DeleteAsset($client);
            $this->userRepository->delete($client->id);
            
            DB::commit();
            
            return redirect(aurl('clients'))->with('success', 'تم حذف الحقل بنجاح');

        } catch (\Throwable $th) {
           
            DB::rollBack();
    
            throw $th;

            return redirect(aurl('clients'))->with('error', 'حدث خطأ ما');
    
        
        }
    }

}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Repositories\ServiceRepository;
use App\Http\Requests\Admin\ServiceRequest;
use App\Models\Service;

class ServiceController extends Controller
{

    private $serviceRepository;
    
    public function __construct(ServiceRepository $service)
    {
        $this->middleware('permission:services-read')->only(['index']);
        $this->middleware('permission:services-create')->only(['create', 'store']);
        $this->middleware('permission:services-update')->only(['edit', 'update']);
        $this->middleware('permission:services-delete')->only(['destroy']);

        $this->serviceRepository = $service;

    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = $this->serviceRepository->all();

        return view('admin.services.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.services.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ServiceRequest $request, Service $service)
    {
                
        try {

            DB::beginTransaction();
            
            $data = $request->except('_token', '_method', 'image');

            $service = $this->serviceRepository->create($data);

            if($request->has('image')){
                $this->UploadAsset(['asset'=>$request->image, 'path_to_save'=>'assets/uploads/services'], $service);
            }
            
            DB::commit();

            return redirect(aurl('services'))->with('success', 'تم إضافة الحقل بنجاح');

        } catch (\Throwable $th) {
           
            DB::rollBack();

            throw $th;

            return redirect(aurl('services'))->with('error', 'حدث خطأ ما');

        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $service = $this->serviceRepository->find($id);

        return view('admin.services.edit', compact('service'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ServiceRequest $request, Service $service)
    {
                
        try {

            DB::beginTransaction();

            $data = $request->except('_token', '_method', 'image');

            $this->serviceRepository->update($data, $service->id);

            if($request->has('image')){

                $this->DeleteAsset($service);
                $this->UploadAsset(['asset'=>$request->image, 'path_to_save'=>'assets/uploads/services'], $service);
            }

            DB::commit();

            return redirect(aurl('services'))->with('success', 'تم تعديل الحقل بنجاح');

        } catch (\Throwable $th) {
           
            DB::rollBack();
    
            throw $th;
        
            return redirect(aurl('services'))->with('error', 'حدث خطأ ما');
        
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
                
        try {

            DB::beginTransaction();

            $this->DeleteAsset($service);
            $this->serviceRepository->delete($service->id);
            
            DB::commit();
            
            return redirect(aurl('services'))->with('success', 'تم حذف الحقل بنجاح');

        } catch (\Throwable $th) {
           
            DB::rollBack();
    
            throw $th;
                
            return redirect(aurl('services'))->with('error', 'حدث خطأ ما');
    
        }
    }
}

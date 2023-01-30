<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\CarTypeRepository;
use App\Http\Requests\Admin\CarTypeRequest;
use App\Models\CarType;

class CarTypeController extends Controller
{

    private $carTypeRepository;
    
    public function __construct(CarTypeRepository $carType)
    {
        $this->middleware('permission:car_types-read')->only(['index']);
        $this->middleware('permission:car_types-create')->only(['create', 'store']);
        $this->middleware('permission:car_types-update')->only(['edit', 'update']);
        $this->middleware('permission:car_types-delete')->only(['destroy']);

        $this->carTypeRepository = $carType;

    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $car_types = $this->carTypeRepository->all();

        return view('admin.car_types.index', compact('car_types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.car_types.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CarTypeRequest $request, CarType $car_type)
    {
            
        $data = $request->except('_token', '_method');

        $this->carTypeRepository->create($data);
        
        return redirect(aurl('car_types'))->with('success', 'تم إضافة الحقل بنجاح');

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $car_type = $this->carTypeRepository->find($id);

        return view('admin.car_types.edit', compact('car_type'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CarTypeRequest $request, CarType $car_type)
    {
                
        $data = $request->except('_token', '_method');

        $this->carTypeRepository->update($data, $car_type->id);

        return redirect(aurl('car_types'))->with('success', 'تم تعديل الحقل بنجاح');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
                
        $this->carTypeRepository->delete($id);
        
        return redirect(aurl('car_types'))->with('success', 'تم حذف الحقل بنجاح');

    }
}

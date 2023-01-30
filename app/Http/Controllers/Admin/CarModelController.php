<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\CarModelRepository;
use App\Http\Requests\Admin\CarModelRequest;
use App\Models\CarModel;

class CarModelController extends Controller
{

    private $carModelRepository;
    
    public function __construct(CarModelRepository $carModel)
    {
        $this->middleware('permission:car_models-read')->only(['index']);
        $this->middleware('permission:car_models-create')->only(['create', 'store']);
        $this->middleware('permission:car_models-update')->only(['edit', 'update']);
        $this->middleware('permission:car_models-delete')->only(['destroy']);

        $this->carModelRepository = $carModel;

    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $car_models = $this->carModelRepository->all();

        return view('admin.car_models.index', compact('car_models'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.car_models.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CarModelRequest $request, CarModel $car_model)
    {
            
        $data = $request->except('_token', '_method');

        $this->carModelRepository->create($data);
        
        return redirect(aurl('car_models'))->with('success', 'تم إضافة الحقل بنجاح');

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $car_model = $this->carModelRepository->find($id);

        return view('admin.car_models.edit', compact('car_model'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CarModelRequest $request, CarModel $car_model)
    {
                
        $data = $request->except('_token', '_method');

        $this->carModelRepository->update($data, $car_model->id);

        return redirect(aurl('car_models'))->with('success', 'تم تعديل الحقل بنجاح');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
                
        $this->carModelRepository->delete($id);
        
        return redirect(aurl('car_models'))->with('success', 'تم حذف الحقل بنجاح');

    }
}

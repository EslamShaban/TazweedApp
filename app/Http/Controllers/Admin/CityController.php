<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\CityRepository;
use App\Http\Requests\Admin\CityRequest;
use App\Models\City;
class CityController extends Controller
{
    
    private $cityRepository;
    
    public function __construct(CityRepository $city)
    {
        $this->middleware('permission:cities-read')->only(['index']);
        $this->middleware('permission:cities-create')->only(['create', 'store']);
        $this->middleware('permission:cities-update')->only(['edit', 'update']);
        $this->middleware('permission:cities-delete')->only(['destroy']);

        $this->cityRepository = $city;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cities = $this->cityRepository->all();
        
        return view('admin.cities.index', compact('cities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.cities.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CityRequest $request)
    {
        $this->cityRepository->create($request->only(['name']));

        return redirect(aurl('cities'))->with('success', 'تم إضافة الحقل بنجاح');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $city = $this->cityRepository->find($id);

        return view('admin.cities.edit', compact('city'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CityRequest $request, City $city)
    {
        $this->cityRepository->update($request->only(['name']), $city->id);

        return redirect(aurl('cities'))->with('success', 'تم تعديل الحقل بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->cityRepository->delete($id);

        return redirect(aurl('cities'))->with('success', 'تم حذف الحقل بنجاح');
    }
}

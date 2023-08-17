<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Repositories\BrandRepository;
use App\Http\Requests\Admin\BrandRequest;
use App\Models\Brand;

class BrandController extends Controller
{

    private $brandRepository;

    public function __construct(BrandRepository $brand)
    {
        // $this->middleware('permission:brands-read')->only(['index']);
        // $this->middleware('permission:brands-create')->only(['create', 'store']);
        // $this->middleware('permission:brands-update')->only(['edit', 'update']);
        // $this->middleware('permission:brands-delete')->only(['destroy']);

        $this->brandRepository = $brand;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = $this->brandRepository->all();

        return view('admin.brands.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.brands.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BrandRequest $request, Brand $brand)
    {

        try {

            DB::beginTransaction();

            $data = $request->except('_token', '_method');

            $brand = $this->brandRepository->create($data);


            DB::commit();

            return redirect(aurl('brands'))->with('success', 'تم إضافة الحقل بنجاح');

        } catch (\Throwable $th) {

            DB::rollBack();

            throw $th;

            return redirect(aurl('brands'))->with('error', 'حدث خطأ ما');

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
        $brand = $this->brandRepository->find($id);

        return view('admin.brands.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BrandRequest $request, Brand $brand)
    {

        try {

            DB::beginTransaction();

            $data = $request->except('_token', '_method');

            $this->brandRepository->update($data, $brand->id);



            DB::commit();

            return redirect(aurl('brands'))->with('success', 'تم تعديل الحقل بنجاح');

        } catch (\Throwable $th) {

            DB::rollBack();

            throw $th;

            return redirect(aurl('brands'))->with('error', 'حدث خطأ ما');

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand)
    {

        try {

            DB::beginTransaction();

            $this->brandRepository->delete($brand->id);

            DB::commit();

            return redirect(aurl('brands'))->with('success', 'تم حذف الحقل بنجاح');

        } catch (\Throwable $th) {

            DB::rollBack();

            throw $th;

            return redirect(aurl('brands'))->with('error', 'حدث خطأ ما');

        }
    }
}

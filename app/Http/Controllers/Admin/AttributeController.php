<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Repositories\AttributeRepository;
use App\Http\Requests\Admin\AttributeRequest;
use App\Models\Attribute;

class AttributeController extends Controller
{

    private $attributeRepository;

    public function __construct(AttributeRepository $attribute)
    {
        // $this->middleware('permission:attributes-read')->only(['index']);
        // $this->middleware('permission:attributes-create')->only(['create', 'store']);
        // $this->middleware('permission:attributes-update')->only(['edit', 'update']);
        // $this->middleware('permission:attributes-delete')->only(['destroy']);

        $this->attributeRepository = $attribute;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $attributes = $this->attributeRepository->all();

        return view('admin.attributes.index', compact('attributes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.attributes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AttributeRequest $request, Attribute $attribute)
    {

        try {

            DB::beginTransaction();

            $data = $request->except('_token', '_method');

            $attribute = $this->attributeRepository->create($data);


            DB::commit();

            return redirect(aurl('attributes'))->with('success', 'تم إضافة الحقل بنجاح');

        } catch (\Throwable $th) {

            DB::rollBack();

            throw $th;

            return redirect(aurl('attributes'))->with('error', 'حدث خطأ ما');

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
        $attribute = $this->attributeRepository->find($id);

        return view('admin.attributes.edit', compact('attribute'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AttributeRequest $request, Attribute $attribute)
    {

        try {

            DB::beginTransaction();

            $data = $request->except('_token', '_method');

            $this->attributeRepository->update($data, $attribute->id);



            DB::commit();

            return redirect(aurl('attributes'))->with('success', 'تم تعديل الحقل بنجاح');

        } catch (\Throwable $th) {

            DB::rollBack();

            throw $th;

            return redirect(aurl('attributes'))->with('error', 'حدث خطأ ما');

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attribute $attribute)
    {

        try {

            DB::beginTransaction();

            $this->DeleteAsset($attribute);
            $this->attributeRepository->delete($attribute->id);

            DB::commit();

            return redirect(aurl('attributes'))->with('success', 'تم حذف الحقل بنجاح');

        } catch (\Throwable $th) {

            DB::rollBack();

            throw $th;

            return redirect(aurl('attributes'))->with('error', 'حدث خطأ ما');

        }
    }
}

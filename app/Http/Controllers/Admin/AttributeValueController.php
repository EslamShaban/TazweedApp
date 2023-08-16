<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Repositories\AttributeValueRepository;
use App\Http\Requests\Admin\AttributeValueRequest;
use App\Models\Attribute;
use App\Models\AttributeValue;

class AttributeValueController extends Controller
{

    private $attributeValueRepository;

    public function __construct(AttributeValueRepository $attributeValue)
    {
        // $this->middleware('permission:attribute_values-read')->only(['index']);
        // $this->middleware('permission:attribute_values-create')->only(['create', 'store']);
        // $this->middleware('permission:attribute_values-update')->only(['edit', 'update']);
        // $this->middleware('permission:attribute_values-delete')->only(['destroy']);

        $this->attributeValueRepository = $attributeValue;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $attributeValues = $this->attributeValueRepository->all();

        return view('admin.attribute_values.index', compact('attributeValues'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $attributes = Attribute::all();

        return view('admin.attribute_values.create', compact('attributes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AttributeValueRequest $request, AttributeValue $attributeValue)
    {

        try {

            DB::beginTransaction();

            $data = $request->except('_token', '_method');

            $attributeValue = $this->attributeValueRepository->create($data);


            DB::commit();

            return redirect(aurl('attribute_values'))->with('success', 'تم إضافة الحقل بنجاح');

        } catch (\Throwable $th) {

            DB::rollBack();

            throw $th;

            return redirect(aurl('attribute_values'))->with('error', 'حدث خطأ ما');

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
        $attributeValue = $this->attributeValueRepository->find($id);
        $attributes = Attribute::all();
        return view('admin.attribute_values.edit', compact('attributeValue', 'attributes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AttributeValueRequest $request, AttributeValue $attributeValue)
    {

        try {

            DB::beginTransaction();

            $data = $request->except('_token', '_method');

            $this->attributeValueRepository->update($data, $attributeValue->id);



            DB::commit();

            return redirect(aurl('attribute_values'))->with('success', 'تم تعديل الحقل بنجاح');

        } catch (\Throwable $th) {

            DB::rollBack();

            throw $th;

            return redirect(aurl('attribute_values'))->with('error', 'حدث خطأ ما');

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(AttributeValue $attributeValue)
    {

        try {

            DB::beginTransaction();

            $this->DeleteAsset($attributeValue);
            $this->attributeValueRepository->delete($attributeValue->id);

            DB::commit();

            return redirect(aurl('attribute_values'))->with('success', 'تم حذف الحقل بنجاح');

        } catch (\Throwable $th) {

            DB::rollBack();

            throw $th;

            return redirect(aurl('attribute_values'))->with('error', 'حدث خطأ ما');

        }
    }
}

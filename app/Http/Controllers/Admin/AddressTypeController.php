<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\AddressTypeRepository;
use App\Http\Requests\Admin\AddressTypeRequest;
use App\Models\AddressType;

class AddressTypeController extends Controller
{

    private $addressTypeRepository;
    
    public function __construct(AddressTypeRepository $addressType)
    {
        $this->middleware('permission:address_types-read')->only(['index']);
        $this->middleware('permission:address_types-create')->only(['create', 'store']);
        $this->middleware('permission:address_types-update')->only(['edit', 'update']);
        $this->middleware('permission:address_types-delete')->only(['destroy']);

        $this->addressTypeRepository = $addressType;

    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $address_types = $this->addressTypeRepository->all();

        return view('admin.address_types.index', compact('address_types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.address_types.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddressTypeRequest $request, AddressType $address_type)
    {
            
        $data = $request->except('_token', '_method');

        $this->addressTypeRepository->create($data);
        
        return redirect(aurl('address_types'))->with('success', 'تم إضافة الحقل بنجاح');

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $address_type = $this->addressTypeRepository->find($id);

        return view('admin.address_types.edit', compact('address_type'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AddressTypeRequest $request, AddressType $address_type)
    {
                
        $data = $request->except('_token', '_method');

        $this->addressTypeRepository->update($data, $address_type->id);

        return redirect(aurl('address_types'))->with('success', 'تم تعديل الحقل بنجاح');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
                
        $this->addressTypeRepository->delete($id);
        
        return redirect(aurl('address_types'))->with('success', 'تم حذف الحقل بنجاح');

    }
}

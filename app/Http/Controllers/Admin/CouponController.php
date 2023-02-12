<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\CouponRepository;
use App\Repositories\ProductRepository;
use App\Repositories\UserRepository;
use App\Http\Requests\Admin\CouponRequest;
use App\Models\Coupon;

class CouponController extends Controller
{

    private $couponRepository, $productRepository, $userRepository;
    
    public function __construct(CouponRepository $coupon, ProductRepository $product, UserRepository $user)
    {
        $this->middleware('permission:coupons-read')->only(['index']);
        $this->middleware('permission:coupons-create')->only(['create', 'store']);
        $this->middleware('permission:coupons-update')->only(['edit', 'update']);
        $this->middleware('permission:coupons-delete')->only(['destroy']);

        $this->couponRepository = $coupon;
        $this->productRepository = $product;
        $this->userRepository = $user;

    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coupons = $this->couponRepository->all();

        return view('admin.coupons.index', compact('coupons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products    = $this->productRepository->all();
        $clients     = $this->userRepository->getUserBaseRole(['client']);

        return view('admin.coupons.create', compact('products', 'clients'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CouponRequest $request, Coupon $coupon)
    {
            
        $data = $request->except('_token', '_method');

        $this->couponRepository->create($data);
        
        return redirect(aurl('coupons'))->with('success', 'تم إضافة الحقل بنجاح');

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $coupon = $this->couponRepository->find($id);
        $products    = $this->productRepository->all();
        $clients     = $this->userRepository->getUserBaseRole(['client']);
        return view('admin.coupons.edit', compact('coupon', 'products', 'clients'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CouponRequest $request, Coupon $coupon)
    {
                
        $data = $request->except('_token', '_method');

        $this->couponRepository->update($data, $coupon->id);

        return redirect(aurl('coupons'))->with('success', 'تم تعديل الحقل بنجاح');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
                
        $this->couponRepository->delete($id);
        
        return redirect(aurl('coupons'))->with('success', 'تم حذف الحقل بنجاح');

    }
}

<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\API\CouponAPIRequest;
use App\Http\Helpers\Coupon;

class CouponAPIController extends Controller
{
        
    public function check_coupon(CouponAPIRequest $request)
    {
                
        return Coupon::apply($request->coupon_code, $request->total_price, $request->product_id);

    }
}

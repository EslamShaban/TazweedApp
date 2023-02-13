<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\ShippingAddressRepository;
use App\Http\Resources\ShippingAddressResource;
use App\Http\Requests\API\ShippingAddressAPIRequest;

class CouponAPIController extends Controller
{
        
    private $userRepository, $couponRepository;
    
    public function __construct(UserRepository $user, CouponRepository $coupon)
    {
        
        $this->userRepository   = $user;
        $this->couponRepository = $coupon;

    }

    public function check_coupon(CouponAPIRequest $request)
    {
                
        $coupon  = Coupon::where('coupon_code', $request->coupon_code)->first();

        if(!$coupon){
            return response()->withError(__('api.coupon_not_exist'), 5003);
        }
        
        $coupon_used_before = CouponUsed::where('user_id', auth()->user()->id)->where('coupon_id', $coupon->id)->first();

        if($coupon_used_before){
            return response()->withError(__('api.you_have_used_before'), 5002);
        }
    
        if($coupon->product_id != null){
            if($coupon->product_id != $product_id){
                return response()->withError(__('api.coupon_not_exist'), 5003);
            }
        }
                            
        if($coupon->user_id != null){
            if($coupon->user_id != $user->id){
                return response()->withError(__('api.coupon_not_exist'), 5003);
            }
        }

        if($coupon->coupon_usage_limit !=0){
            if($coupon->coupon_usage_limit <= $coupon->coupon_usage_coount){
                return response()->withError(__('api.coupon_exceed_limit'), 5004);
            }
        }

        $today = \Carbon\Carbon::now()->toDateTimeString();
        $current_date = strtotime('+2 hours', strtotime($today));
        $start_date = strtotime($coupon->start_date);
        $end_date = strtotime($coupon->end_date);

        if($current_date >= $start_date  && $current_date <= $end_date)
        {
                    
            if($coupon->discount_type == 'amount'){

                if($total_price < $coupon->minimum)
                    return response()->withError(__('api.coupon_minimum'), 5006);
                    
                $total_price -= $coupon->discount_amount;

            }else{
                
                $total_price -= ($coupon->discount_percentage/100 * $total_price); 
                                                                        
            }

        }else{
            return response()->withError(__('api.coupon_expired'), 5005);
        }          
 
        
    }

}

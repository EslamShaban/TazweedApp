<?php

namespace App\Http\Helpers;
use App\Models\Coupon as CouponModel;
use App\Models\User;
use App\Models\CouponUsed;

class Coupon{

    public static function apply($coupon_code, $total_price, $product_id = null)
    {
       
        $coupon  = CouponModel::where('coupon_code', $coupon_code)->first();
        $user = auth()->user();

        if(!$coupon){
            return response()->withError(__('api.coupon_not_exist'), 5004);
        }
        
        $coupon_used_before = CouponUsed::where('user_id', $user->id)->where('coupon_id', $coupon->id)->first();

        if($coupon_used_before){
            return response()->withError(__('api.you_have_used_before'), 5005);
        }
    
        if($coupon->product_id != null){
            if($coupon->product_id != $product_id){
                return response()->withError(__('api.coupon_not_exist'), 5004);
            }
        }
                            
        if($coupon->user_id != null){
            if($coupon->user_id != $user->id){
                return response()->withError(__('api.coupon_not_exist'), 5004);
            }
        }

        if($coupon->coupon_usage_limit !=0){
            if($coupon->coupon_usage_limit <= $coupon->coupon_usage_count){
                return response()->withError(__('api.coupon_exceeded_limit'), 5006);
            }
        }

        $today = \Carbon\Carbon::now()->toDateTimeString();
        $current_date = strtotime('+2 hours', strtotime($today));
        $start_date = strtotime($coupon->start_date);
        $end_date = strtotime($coupon->end_date);

        if($current_date >= $start_date  && $current_date <= $end_date)
        {    
            
            if($coupon->discount_type == 'amount'){
                            
                if($total_price < $coupon->minimum){
                    return response()->withError(__('api.coupon_minimum'), 5007);
                }
            }

            return self::calculate_discount($coupon, $total_price);

        }else{
            return response()->withError(__('api.coupon_expired'), 5008);
        }          
 
    }

        
    public static function calculate_discount($coupon, $total_price)
    {

        $total_price -= $coupon->discount_type == 'amount' 
                    ? $coupon->discount_amount 
                    : ($coupon->discount_percentage/100 * $total_price);

        return response()->withData(__('api.success_coupon'), ['total_price' => number_format($total_price,2)]);

    }

}
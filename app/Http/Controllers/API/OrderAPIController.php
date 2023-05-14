<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Repositories\OrderRepository;
use App\Http\Requests\API\OrderAPIRequest;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use App\Http\Helpers\Coupon;

class OrderAPIController extends Controller
{
    
    private  $orderRepository;
    
    public function __construct(OrderRepository $order)
    {
        $this->orderRepository = $order;
    } 
        
    public function make_order(OrderAPIRequest $request)
    {
        try {

            DB::beginTransaction();

            $order = $this->orderRepository->create([
                'user_id' => auth()->user()->id,
                'shipping_address_id' => $request->shipping_address_id
            ]);

            $order_total_price = 0;

            foreach ($request->cart_items as $key => $item) {

                $product = Product::find($item['product_id']);

                $product_price =  $product->is_offer == 0 ? $product->price : $product->discount_price ;

                $item_total_price = $product_price * $item['qty'];
                                        
                $order->items()->create([
                    'product_id'=> $item['product_id'],
                    'unit_price'=>$product_price,
                    'qty'=> $item['qty'],
                    'total_price'=> $item_total_price
                ]);

                $order_total_price += $item_total_price;
            }

                        
            if($request->has('coupon_code') && $request->coupon_code != null){

                $chkcoupon = Coupon::apply($request->coupon_code, $order_total_price)->getData();
                
                if($chkcoupon->success){
                    $discount = $order_total_price - $chkcoupon->data->total_price;
                    $order_total_price = $chkcoupon->data->total_price;
                    $coupon_code = $request->coupon_code;
                }
            }

            $order->update([
                'total_price' => $order_total_price,
                'coupon_code' => $coupon_code??null,
                'discount' => $discount??null
            ]);

            DB::commit();

            return response()->withSuccess(__('api.ordered_successfully'), 200);


        } catch (\Throwable $th) {
            
            DB::rollBack();

            return response()->withError($th->getMessage(), $th->getCode());
        
        }

    }
}

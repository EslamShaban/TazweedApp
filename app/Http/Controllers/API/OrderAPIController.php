<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\OrderRepository;
use App\Http\Requests\API\OrderAPIRequest;
use App\Models\Order;
use App\Models\OrderItem;

class OrderAPIController extends Controller
{
    
    private  $orderRepository;
    
    public function __construct(OrderRepository $order)
    {
        $this->orderRepository = $order;
    } 
        
    public function make_order(OrderRequest $request)
    {


    }
}

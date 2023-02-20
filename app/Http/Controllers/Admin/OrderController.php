<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\OrderRepository;

class OrderController extends Controller
{
        
    private  $orderRepository;
    
    public function __construct(OrderRepository $order)
    {
        $this->middleware('permission:orders-read')->only(['index', 'show']);

        $this->orderRepository = $order;
    } 

    public function index()
    {
        $orders = $this->orderRepository->all();

        return view('admin.orders.index', compact('orders'));
    }



    public function show($id)
    {
        $order = $this->orderRepository->find($id);

        return view('admin.orders.show' , compact('order'));
    }
}

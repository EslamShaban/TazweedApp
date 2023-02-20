@extends('layouts.admin.app')

@section('title', __('models.order_details'))

@section('content')
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">{{ __('admin.order_details') }}</a>
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- Basic table -->
                <section id="basic-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card" style="padding: 10px;">
                                <table class="table table-bordered table-hover" id="datatable">
                                    <thead>
                                        <tr>
                                        <th>{{ __('admin.product_name') }}</th>
                                        <th>{{ __('admin.unit_price')  }}</th>
                                        <th>{{ __('admin.quantity') }}</th>
                                        <th>{{ __('admin.total_price')  }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                                    
                                    @php
                                        $order_items = \App\Models\OrderItem::where('order_id', $order->id)->get();
                                        $sub_total = 0;
                                    @endphp
                                    @foreach ($order_items as $item) 
                                        @php $sub_total += $item->total_price; $choices_total_price = 0;@endphp               
                                        <tr>
                                            <td>{{$item->product->name . '(' . $item->unit_price .')'}}</td>
                                            <td>{{$item->unit_price}}</td>
                                            <td>{{$item->qty}}</td>
                                            <td>{{$item->total_price}}</td>
                                        </tr> 
                                    @endforeach

                                    @php
                                        $gas = ($sub_total * 3)/100;
                                    @endphp
                                    <tr>
                                        <td colspan="3" style="text-align: end">{{ __('admin.sub_total')}}</td>
                                        <td>{{ $sub_total }}</td>
                                    </tr>
                                    {{-- <tr>
                                        <td colspan="4" style="text-align: end">{{ __('models.gst')}}(3%)</td>
                                        <td>{{ $gas }}</td>
                                    </tr> --}}
                                    <tr>
                                        <td colspan="3" style="text-align: end">{{ __('admin.grand_total')}}</td>
                                        <td>{{ $sub_total }}</td>
                                    </tr>
                                    </tbody>
                                </table>                 
                            </div>
                        </div>
                    </div>
                </section>
                <!--/ Basic table -->
            </div>
        </div>
    </div>
    <!-- END: Content-->
@endsection

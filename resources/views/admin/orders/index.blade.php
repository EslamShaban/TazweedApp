@extends('layouts.admin.app')

@section('title', __('admin.orders'))

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
                                    <li class="breadcrumb-item"><a href="#">{{ __('admin.orders') }}</a>
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

                    <!-- Order Table Card -->
                    <div class="col-lg-12 col-12">
                        <div class="card card-company-table">
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table" id="dataTable">
                                        <thead>
                                            <tr>
                                                <th>{{ __('admin.order_code') }}</th>
                                                <th>{{ __('admin.client_name')  }}</th>
                                                <th>{{ __('admin.total_price') }}</th>
                                                <th>{{ __('admin.created_at') }}</th>
                                                <th>{{ __('admin.action') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach ($orders as $order )

                                            <tr>

                                                <td>{{ $order->id }}</td>
                                                <td>{{ $order->user->f_name . ' ' . $order->user->l_name  }}</td>
                                                <td>{{ $order->total_price }}</td>
                                                <td>{{ $order->created_at->diffForHumans() }}</td>                                                 
                                                <td> 
                                                    <a href="{{route('admin.orders.show', $order->id)}}" class="edit-btn"><i class="fa fa-eye fa-sm"></i> </a>
                                                </td>
                                            </tr>

                                            @endforeach


                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/ Order Table Card -->

                </section>
                <!--/ Basic table -->
            </div>
        </div>
    </div>
    <!-- END: Content-->
@endsection

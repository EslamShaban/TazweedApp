@extends('layouts.admin.app')

@section('title', __('admin.wash_requests'))

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
                                    <li class="breadcrumb-item"><a href="#">{{ __('admin.wash_requests') }}</a>
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

                    <!-- Wash Requests Table Card -->
                    <div class="col-lg-12 col-12">
                        <div class="card card-company-table">
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table" id="dataTable">
                                        <thead>
                                            <tr>
                                                <th>{{ __('admin.wash_code') }}</th>
                                                <th>{{ __('admin.client_name')  }}</th>
                                                <th>{{ __('admin.captain_name') }}</th>
                                                <th>{{ __('admin.location') }}</th>
                                                <th>{{ __('admin.status') }}</th>
                                                <th>{{ __('admin.created_at') }}</th>
                                                <th>{{ __('admin.action') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach ($wash_requests as $wash_request )

                                                <tr>

                                                    <td>{{ $wash_request->id }}</td>
                                                    <td>{{ $wash_request->client->f_name . ' ' . $wash_request->client->l_name  }}</td>
                                                    <td>{{  $wash_request->captain ? $wash_request->captain->f_name . ' ' . $wash_request->captain->l_name : __('admin.unset_captain')}}</td>
                                                    <td>{{ $wash_request->location }}</td>
                                                    <td>{{ $wash_request->status }}</td>
                                                    <td>{{ $wash_request->created_at->diffForHumans() }}</td>                                                 
                                                    <td> 
                                                        <a href="{{route('admin.wash_requests.show', $wash_request->id)}}" class="edit-btn"><i class="fa fa-eye fa-sm"></i> </a>
                                                    </td>
                                                </tr>

                                            @endforeach


                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/ Wash Requests Table Card -->

                </section>
                <!--/ Basic table -->
            </div>
        </div>
    </div>
    <!-- END: Content-->
@endsection

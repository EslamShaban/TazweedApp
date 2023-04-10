@extends('layouts.admin.app')

@section('title', __('admin.reports'))

@section('content')
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">{{ __('admin.reports')}}</a>
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

                    <!-- Questions Table Card -->
                    <div class="col-lg-12 col-12">
                        <div class="card card-company-table">
                            <div class="report">
                                <form action="{{route('admin.reports.bw_dates_report')}}" class="bw-dates-washrequest-report">
                                <div class="row">       
                                    <div class="col-4">
                                        <div class="mb-1">
                                            <label for="from_date">From Date</label>
                                            <input type="date" id="from_date" name="from_date" class="form-control" value="{{request('from_date')}}">
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="mb-1">
                                            <label for="to_date">To Date</label>
                                            <input type="date" id="to_date" name="to_date" class="form-control" value="{{request('to_date')}}">
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="mb-1">
                                            <label for="status">{{ __('admin.status') }}</label>                                                                                                
                                            <select name="status" class="form-control">
                                                <option value="">{{ __('admin.status')}}</option>
                                                <option value="created" @selected(request('status') == 'created')>created</option>
                                                <option value="waiting" @selected(request('status') == 'waiting')>waiting</option>
                                                <option value="approved" @selected(request('status') == 'approved')>approved</option>
                                                <option value="arrived" @selected(request('status') == 'arrived')>arrived</option>
                                                <option value="washing" @selected(request('status') == 'washing')>washing</option>
                                                <option value="finishing" @selected(request('status') == 'finishing')>finishing</option>
                                            </select>
                                        </div>
                                    </div>
                                    <button class="btn btn-primary" type="submit" style="margin:auto">{{ __('admin.submit') }}</button>

                                </div>
                                </form>
                            </div>
                            
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover" id="dataTable">
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
                    <!--/ Reports Table Card -->

                </section>
                <!--/ Basic table -->
            </div>
        </div>
    </div>
@endsection

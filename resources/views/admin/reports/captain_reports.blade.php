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
                                <form action="{{route('admin.reports.captain_reports')}}" class="bw-dates-washrequest-report">
                                <div class="row">                          
                                    <div class="col-6">
                                        <div class="mb-1">
                                            <label for="captain_id">{{ __('admin.captains') }}</label>                                                                                                
                                            <select name="captain_id" class="form-control">
                                                <option value="">{{ __('admin.captains')}}</option>
                                                @foreach (\App\Models\User::where('account_type', 'captain')->get() as $captain)
                                                    <option value="{{$captain->id}}" @selected($captain->id == request('captain_id'))>{{ $captain->f_name . ' ' . $captain->l_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>     
                                    {{-- <div class="col-6">
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
                                    </div> --}}
                                    <button class="btn btn-primary" type="submit" style="margin:auto">{{ __('admin.submit') }}</button>

                                </div>
                                </form>
                            </div>
                            
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th>{{ __('admin.wash_code') }}</th>
                                            <th>{{ __('admin.location') }}</th>
                                            <th>{{ __('admin.distance') }}</th>
                                            <th>{{ __('admin.captain_response') }}</th>
                                            <th>{{ __('admin.client_response') }}</th>
                                             <th>{{ __('admin.tip') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($wash_requests as $wash_request )

                                            <tr>

                                                <td>{{ $wash_request->id }}</td>
                                                <td>{{ $wash_request->location }}</td>
                                                <td>{{ $wash_request->distance . ' ' . __('admin.km') }} </td>
                                                <td><div class="badge badge-light-primary">{{ __('admin.' . $wash_request->captain_response) }}</div></td>                                          
                                                @if ($wash_request->captain_id == request('captain_id')) 
                                                    <td><div class="badge badge-light-primary">{{ __('admin.approve') }}</div></td>
                                                    <td>{{ $wash_request->tip }}</td>
                                                @else
                                                    <td><div class="badge badge-light-danger">{{ __('admin.not_approve') }}</div></td>
                                                    <td>-</td>
                                                @endif
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

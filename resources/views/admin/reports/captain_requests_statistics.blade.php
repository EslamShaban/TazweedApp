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
                                <form action="{{route('admin.reports.captain_requests_statistics')}}" class="bw-dates-washrequest-report">
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
                                    <button class="btn btn-primary" type="submit" style="margin:auto">{{ __('admin.submit') }}</button>

                                </div>
                                </form>
                            </div>
                            
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th>الطلبات اللي اشتغلها الكابتن</th>
                                            <th>الطلبات اللي قبلها بس مشتغلهاش</th>
                                            <th>الطلبات اللي رفضها</th>
                                            <th>الطلبات اللي جتله بس مخدتش اكشن</th>
                                            <th>مجموع البقشيش </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(! empty($captain_statistics))
                                            <tr>
                                                <td>{{ $captain_statistics['requests'] }}</td>
                                                <td>{{ $captain_statistics['approved_requests'] }}</td>
                                                <td>{{ $captain_statistics['rejected_requests'] }} </td>
                                                <td>{{ $captain_statistics['no_action_requests'] }} </td>
                                                <td>{{ $captain_statistics['tips'] }}</td>
                                            </tr>
                                        @endif
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

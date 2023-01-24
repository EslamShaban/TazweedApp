@extends('layouts.admin.app')

@section('title', 'الصلاحيات')

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
                                    <li class="breadcrumb-item"><a href="#">الصلاحيات</a>
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
                    <div class="form-group breadcrumb-right">
                        <div class="dropdown">
                            <div class="card-toolbar" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover" title="Click to add a Admin">
                                <a href="{{ route('admin.admins.create') }}" class="btn btn-primary">
                                    <span><i class="fa fa-plus"></i></span>
                                    <span> أضف مشرف </span>
                                </a>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- Basic table -->
                <section id="basic-datatable">

                    <!-- Roles Table Card -->
                    <div class="col-lg-12 col-12">
                        <div class="card card-company-table">
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table" id="dataTable">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>الصورة</th>
                                                <th>الإسم الاول</th>
                                                <th>الإسم الاخير</th>
                                                <th>البريد الإلكتروني</th>
                                                <th>الصلاحيات</th>
                                                <th>تاريخ الإضافة</th>
                                                <th>تحكم</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach ($admins as $index=>$admin )
                                                <tr>                  
                                                    <td>{{$index + 1 }}</td>
                                                    <td>                                        
                                                        <div data-toggle="tooltip" data-popup="tooltip-custom" data-placement="top" title="" class="avatar pull-up my-0" data-original-title="{{ $admin->f_name }}">
                                                            <img src="{{ $admin->image_path }}" alt="Avatar" height="50" width="50" />
                                                        </div>
                                                    </td>
                                                    <td>{{ $admin->f_name }}</td>
                                                    <td>{{ $admin->l_name }}</td>
                                                    <td>{{ $admin->email }}</td>
                                                    <td>
                                                        @foreach ($admin->roles as $adminRole)
                                                            <h5 style="margin-bottom:5px"><span class="badge badge-info" >{{ $adminRole->name}}</span><h5>
                                                        @endforeach
                                                    </td>
                                                    <td>{{ $admin->created_at->diffForHumans() }}</td>
                                                    <td>  
                                                        @if(auth()->user()->hasPermission('admins-update'))
                                                        <a href="{{route('admin.admins.edit', $admin->id)}}" class="edit-btn"><i class="fa fa-edit fa-sm"></i> </a>
                                                        @endif
                                                        @if(auth()->user()->hasPermission('admins-delete'))
                                                            <a href="#" class="delete-btn deleteNotify" id="deleteNotify" onclick="deleteItem('#delete_item_{{$admin->id}}')"><i class="fa fa-trash fa-sm"></i> </a>
                                                        @endif
                                                        <form action="{{route('admin.admins.destroy', $admin->id)}}" method="POST" id="delete_item_{{$admin->id}}">
                                                            @csrf
                                                            <input type="hidden" name="_method" value="delete"/>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach


                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/ Roles Table Card -->

                </section>
                <!--/ Basic table -->
            </div>
        </div>
    </div>
@endsection

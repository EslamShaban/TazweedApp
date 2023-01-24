@extends('layouts.admin.app')

@section('title', 'العملاء')

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
                                    <li class="breadcrumb-item"><a href="#">العملاء</a>
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
                    <div class="form-group breadcrumb-right">
                        <div class="dropdown">
                            <div class="card-toolbar" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover" title="Click to add a Client">
                                <a href="{{ route('admin.clients.create') }}" class="btn btn-primary">
                                    <span><i class="fa fa-plus"></i></span>
                                    <span> أضف عميل </span>
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
                                                <th>المحافظة</th>
                                                <th>البريد الإلكتروني</th>
                                                <th>تاريخ الإضافة</th>
                                                <th>تحكم</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach ($clients as $index=>$client )
                                                <tr>                  
                                                    <td>{{$index + 1 }}</td>
                                                    <td>                                        
                                                        <div data-toggle="tooltip" data-popup="tooltip-custom" data-placement="top" title="" class="avatar pull-up my-0" data-original-title="{{ $client->f_name }}">
                                                            <img src="{{ $client->image_path }}" alt="Avatar" height="50" width="50" />
                                                        </div>
                                                    </td>
                                                    <td>{{ $client->f_name }}</td>
                                                    <td>{{ $client->l_name }}</td>
                                                    <td>{{ $client->city->name }}</td>
                                                    <td>{{ $client->email }}</td>
                                                    <td>{{ $client->created_at->diffForHumans() }}</td>
                                                    <td>  
                                                        @if(auth()->user()->hasPermission('clients-update'))
                                                        <a href="{{route('admin.clients.edit', $client->id)}}" class="edit-btn"><i class="fa fa-edit fa-sm"></i> </a>
                                                        @endif
                                                        @if(auth()->user()->hasPermission('clients-delete'))
                                                            <a href="#" class="delete-btn deleteNotify" id="deleteNotify" onclick="deleteItem('#delete_item_{{$client->id}}')"><i class="fa fa-trash fa-sm"></i> </a>
                                                        @endif
                                                        <form action="{{route('admin.clients.destroy', $client->id)}}" method="POST" id="delete_item_{{$client->id}}">
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

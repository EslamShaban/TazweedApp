@extends('layouts.admin.app')

@section('title', 'الأقسام')

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
                                    <li class="breadcrumb-item"><a href="#">الأقسام</a>
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
                    <div class="form-group breadcrumb-right">
                        <div class="dropdown">
                            <div class="card-toolbar" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover" title="Click to add a Category">
                                <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">
                                    <span><i class="fa fa-plus"></i></span>
                                    <span> أضف قسم </span>
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
                                                <th>صورة القسم</th>
                                                <th>إسم القسم</th>
                                                <th>تاريخ الإضافة</th>
                                                <th>تحكم</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach ($categories as $index=>$category )
                                                <tr>                  
                                                    <td>{{$index + 1 }}</td>
                                                    <td>                                        
                                                        <div data-toggle="tooltip" data-popup="tooltip-custom" data-placement="top" title="" class="avatar pull-up my-0" data-original-title="{{ $category->name }}">
                                                            <img src="{{ $category->image_path }}" alt="Avatar" height="50" width="50" />
                                                        </div>
                                                    </td>
                                                    <td>{{ $category->name }}</td>
                                                    <td>{{ $category->created_at->diffForHumans() }}</td>
                                                    <td>  
                                                        @if(auth()->user()->hasPermission('categories-update'))
                                                        <a href="{{route('admin.categories.edit', $category->id)}}" class="edit-btn"><i class="fa fa-edit fa-sm"></i> </a>
                                                        @endif
                                                        @if(auth()->user()->hasPermission('categories-delete'))
                                                            <a href="#" class="delete-btn deleteNotify" id="deleteNotify" onclick="deleteItem('#delete_item_{{$category->id}}')"><i class="fa fa-trash fa-sm"></i> </a>
                                                        @endif
                                                        <form action="{{route('admin.categories.destroy', $category->id)}}" method="POST" id="delete_item_{{$category->id}}">
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

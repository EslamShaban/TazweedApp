@extends('layouts.admin.app')

@section('title', __('admin.attribute_values'))

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
                                    <li class="breadcrumb-item"><a href="#">{{__('admin.attribute_values')}}</a>
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
                                <a href="{{ route('admin.attribute_values.create') }}" class="btn btn-primary">
                                    <span><i class="fa fa-plus"></i></span>
                                    <span> {{__('admin.add_attribute_value')}} </span>
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
                                                <th>{{ __('admin.attribute_value_name')}}</th>
                                                <th>{{ __('admin.attribute')}}</th>
                                                <th>{{ __('admin.created_at')}}</th>
                                                <th>{{__('admin.action')}}</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach ($attributeValues as $index=>$attributeValue )
                                                <tr>
                                                    <td>{{$index + 1 }}</td>

                                                    <td>{{ $attributeValue->name }}</td>
                                                    <td>{{ optional($attributeValue->attribute)->name }}</td>
                                                    <td>{{ $attributeValue->created_at->diffForHumans() }}</td>
                                                    <td>
                                                        @if(auth()->user()->hasPermission('attribute_values-update'))
                                                        <a href="{{route('admin.attribute_values.edit', $attributeValue->id)}}" class="edit-btn"><i class="fa fa-edit fa-sm"></i> </a>
                                                        @endif
                                                        @if(auth()->user()->hasPermission('attribute_values-delete'))
                                                            <a href="#" class="delete-btn deleteNotify" id="deleteNotify" onclick="deleteItem('#delete_item_{{$attributeValue->id}}')"><i class="fa fa-trash fa-sm"></i> </a>
                                                        @endif
                                                        <form action="{{route('admin.attribute_values.destroy', $attributeValue->id)}}" method="POST" id="delete_item_{{$attributeValue->id}}">
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
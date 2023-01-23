@extends('layouts.admin.app')

@section('title' , 'تعديل الصلاحية')

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
                                    <li class="breadcrumb-item"><a href="{{ route('admin.roles.index') }}">الصلاحيات</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">تعديل الصلاحية</a>
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- Basic Vertical form layout section start -->
                <section id="basic-vertical-layouts">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h2 class="card-title">تعديل الصلاحية</h2>
                                </div>
                                <div class="card-body">
                                    <form class="form form-vertical needs-validation" action="{{ route('admin.roles.update' , $role->id) }}" method="POST">                                    
                                        @method('PUT')
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-6 col-12 mb-3">
                                                <label for="name">إسم الصلاحية</label>
                                                    <input type="text" id="name" class="form-control" name="name"
                                                        value="{{ old('name' , $role->name) }}" required/>

                                                    @error('name')
                                                        <span class="text-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                            </div>
                    
                                            <div class="table-responsive">
                                                <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>الموديل</th>
                                                        <th>الصلاحيات</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $models = config('laratrust_seeder.models_arabic');
                                                        $permissions_map = config('laratrust_seeder.permissions_map_arabic');
                                                    @endphp
                                                    @foreach (config('laratrust_seeder.roles_structure.superadmin') as $model=>$permissions)

                                                        <tr>
                                                            <td>{{ $models[$model] }}</td>
                                                            <td>
                                                                <div class="permissions">

                                                                @foreach (explode(',' ,$permissions) as $permission)
                                                                        
                                                                    <input type="checkbox" value="{{$model}}-{{config('laratrust_seeder.permissions_map')[$permission]}}" name="permissions[]"  class="{{$model}}" {{ $role->hasPermission($model . '-' . config('laratrust_seeder.permissions_map')[$permission]) ? 'checked':''}}>
                                                                    <label>{{ $permissions_map[$permission] }}</label>
                                                                    
                                                                @endforeach

                                                                </div>
                                                            </td>

                                                        </tr>

                                                    @endforeach
                                                        
                                                </tbody>
                                                </table>
                                            </div>
 
                                            <div class="col-12">
                                                <button type="submit" class="btn btn-primary mr-1">حفظ البيانات</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Basic Vertical form layout section end -->
            </div>
        </div>
    </div>
    <!-- END: Content-->

    @push('js')
    <script src="{{ asset('dashboard/assets/js/custom/validation/AdminForm.js') }}"></script>
    <script src="{{ asset('dashboard/app-assets/js/custom/preview-image.js') }}"></script>

    @endpush
@endsection

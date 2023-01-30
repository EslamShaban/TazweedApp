@extends('layouts.admin.app')

@section('title' , 'تعديل نوع السيارة')

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
                                    <li class="breadcrumb-item"><a href="{{ route('admin.categories.index') }}">الأقسام</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">تعديل نوع السيارة</a>
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
                                    <h2 class="card-title">تعديل نوع السيارة</h2>
                                </div>
                                <div class="card-body">
                                    <form class="form form-vertical needs-validation" action="{{ route('admin.car_types.update' , $car_type->id) }}" method="POST">                                    
                                        @method('PUT')
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-12 mb-3">
                                                <label for="type">نوع السيارة</label>
                                                    <input type="text" id="type" class="form-control" name="type"
                                                        value="{{ old('type' , $car_type->type) }}" required/>

                                                    @error('type')
                                                        <span class="text-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
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

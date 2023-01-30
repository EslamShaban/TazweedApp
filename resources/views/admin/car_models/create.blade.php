@extends('layouts.admin.app')

@section('title' , 'أضف موديل سيارة')

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
                                    <li class="breadcrumb-item"><a href="{{ route('admin.car_models.index') }}">موديلات السيارات</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">أضف موديل سيارة</a>
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
                                    <h2 class="card-title">أضف موديل سيارة</h2>
                                </div>
                                <div class="card-body">
                                    <form class="form form-vertical needs-validation" action="{{ route('admin.car_models.store') }}" method="POST" >
                                        @csrf
                                        <div class="row"> 
                                            <div class="col-md-12 mb-3">
                                                <label for="model">موديل السيارة</label>
                                                    <input type="text" id="model" class="form-control" name="model" value="{{ old('model') }}" required/>
                                                    @error('model')
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
@endsection

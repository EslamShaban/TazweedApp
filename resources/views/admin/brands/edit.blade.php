@extends('layouts.admin.app')

@section('title' , __('admin.edit_brand'))

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
                                    <li class="breadcrumb-item"><a href="{{ route('admin.brands.index') }}">{{ __('admin.brands') }}</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">{{ __('admin.edit_brand') }}</a>
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
                                    <h2 class="card-title">{{ __('admin.edit_brand') }}</h2>
                                </div>
                                <div class="card-body">
                                    <form class="form form-vertical needs-validation" action="{{ route('admin.brands.update' , $brand->id) }}" method="POST" enctype="multipart/form-data">
                                        @method('PUT')
                                        @csrf
                                        <div class="row">
                                            @foreach (config('translatable.locales') as $locale)

                                                <div class="col-md-6 col-12 mb-3">
                                                    <label for="{{$locale}}.name">{{ __('admin.'. $locale . '.brand_name')}}</label>
                                                    <input type="text" id="{{$locale}}.name" class="form-control" name="{{$locale}}[name]" value="{{$brand->translate($locale)->name}}" required/>

                                                    @error($locale . '.name')
                                                        <span class="text-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>
                                            @endforeach

                                            @foreach (config('translatable.locales') as $locale)
                                                <div class="col-md-6 col-12 mb-3">
                                                    <label for="{{$locale}}.description">{{ __('admin.'. $locale . '.brand_description')}}</label>
                                                    <textarea  id="{{$locale}}.description" class="form-control" name="{{$locale}}[description]" required>{{$brand->translate($locale)->description}}</textarea>
                                                    @error($locale . '.description')
                                                        <span class="text-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>
                                            @endforeach
                                            <div class="col-12">
                                                <button type="submit" class="btn btn-primary mr-1 mt-1">{{ __('admin.save') }}</button>
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
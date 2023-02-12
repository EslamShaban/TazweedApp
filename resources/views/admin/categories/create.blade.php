@extends('layouts.admin.app')

@section('title', __('admin.add_category') )

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
                                    <li class="breadcrumb-item"><a href="{{ route('admin.categories.index') }}">{{__('admin.categories') }}</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">{{__('admin.add_category') }}</a>
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
                                    <h2 class="card-title">{{__('admin.add_category') }}</h2>
                                </div>
                                <div class="card-body">
                                    <form class="form form-vertical needs-validation" action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">                                     
                                            @foreach (config('translatable.locales') as $locale)                                   
                                                <div class="col-md-6 col-12 mb-3">
                                                    <label for="{{$locale}}.name">{{ __('admin.'. $locale . '.category_name')}}</label>
                                                    <input type="text" id="{{$locale}}.name" class="form-control" name="{{$locale}}[name]" value="{{old($locale . '.name')}}" required/>
                                                    @error($locale . '.name')
                                                        <span class="text-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>
                                            @endforeach                        
                                            <div class="col-md-12">           
                                                <label for="image">{{ __('admin.image') }}</label>
                                                <div class="uploadOuter">
                                                    <span class="dragBox" >
                                                        <i class="fa fa-cloud-upload-alt fa-2x"></i>
                                                        <input type="file" name="image" onChange="dragNdrop(event)"  ondragover="drag()" ondrop="drop()" id="uploadFile"  />
                                                    </span>
                                                </div>
                                                <div id="preview"></div>
                                            </div>

                                            <div class="col-12">
                                                <button type="submit" class="btn btn-primary mr-1 mt-1"> {{ __('admin.save') }} </button>
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

@extends('layouts.admin.app')

@section('title' ,  __('admin.edit_settings'))

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
                                    <li class="breadcrumb-item"><a href="{{ route('admin.questions.index') }}">{{__('admin.settings')}}</a>
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
                                    <h2 class="card-title">{{ __('admin.settings') }}</h2>
                                </div>
                                <div class="card-body">
                                    <form class="form form-vertical needs-validation" action="{{ route('admin.settings.update')}}" method="POST" enctype="multipart/form-data">                                    
                                        @method('PUT')
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-12 mb-2">           
                                                <label for="app_logo">{{ __('admin.app_logo')}}</label>
                                                <div class="uploadOuter">
                                                    <span class="dragBox" >
                                                        <i class="fa fa-cloud-upload-alt fa-2x"></i>
                                                        <input type="file" name="app_logo" onChange="dragNdrop(event)"  ondragover="drag()" ondrop="drop()" id="uploadFile"  />
                                                    </span>
                                                </div>
                                                <div id="preview">
                                                    <img src="{{asset($settings->app_logo)}}" class="imgPreview img-thumbnail">
                                                </div>
                                            </div>                                 
                                            @foreach (config('translatable.locales') as $locale)                                   
                                                <div class="col-md-6 col-12 mb-3">
                                                    <label for="{{$locale}}.app_name">{{ __('admin.'. $locale . '.app_name')}}</label>
                                                    <input type="text" id="{{$locale}}.app_name" class="form-control" name="{{$locale}}[app_name]" value="{{$settings->translate($locale)->app_name ?? ''}}"/>
                                                    @error($locale . '.app_name')
                                                        <span class="text-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>
                                            @endforeach     
                                                                                        
                                            @foreach (config('translatable.locales') as $locale)                                   
                                                <div class="col-md-6 col-12 mb-3">
                                                    <label for="{{$locale}}.app_info">{{ __('admin.'. $locale . '.app_info')}}</label>
                                                    <input type="text" id="{{$locale}}.app_info" class="form-control" name="{{$locale}}[app_info]" value="{{$settings->translate($locale)->app_info ?? ''}}"/>
                                                    @error($locale . '.app_info')
                                                        <span class="text-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>
                                            @endforeach  
                          
                                            <div class="col-md-6 col-12 mb-3">
                                                <label for="service_price">{{ __('admin.service_price')}}</label>
                                                <input type="number" class="form-control" id="service_price" name="service_price" value="{{$settings->service_price}}">
                                                @error('service_price')
                                                    <span class="text-danger">
                                                        <small class="errorTxt">{{ $message }}</small>
                                                    </span>
                                                @enderror
                                            </div> 
                                            <div class="col-md-6 col-12 mb-3">
                                                <label for="delivery_price">{{ __('admin.delivery_price')}}</label>
                                                <input type="number" class="form-control" id="delivery_price" name="delivery_price" value="{{$settings->delivery_price}}">
                                                @error('delivery_price')
                                                    <span class="text-danger">
                                                        <small class="errorTxt">{{ $message }}</small>
                                                    </span>
                                                @enderror
                                            </div> 
                                            <div class="col-md-6 col-12 mb-3">
                                                <label for="tax">{{ __('admin.tax')}}</label>
                                                <input type="number" class="form-control" id="tax" name="tax" value="{{$settings->tax}}">
                                                @error('tax')
                                                    <span class="text-danger">
                                                        <small class="errorTxt">{{ $message }}</small>
                                                    </span>
                                                @enderror
                                            </div> 
                                            <div class="col-md-6 col-12 mb-3">
                                                <label for="contact_email">{{ __('admin.contact_email')}}</label>
                                                <input type="email" class="form-control" id="contact_email" name="email" value="{{$settings->email}}">
                                                @error('email')
                                                    <span class="text-danger">
                                                        <small class="errorTxt">{{ $message }}</small>
                                                    </span>
                                                @enderror
                                            </div>    
                                                                                       
                                            <div class="col-md-6 col-12 mb-3">
                                                <label for="phone">{{ __('admin.phone')}}</label>
                                                <input type="text" class="form-control" id="phone" name="email" value="{{$settings->phone}}">
                                                @error('phone')
                                                    <span class="text-danger">
                                                        <small class="errorTxt">{{ $message }}</small>
                                                    </span>
                                                @enderror
                                            </div>  
                                            <div class="col-md-6 col-12 mb-3">
                                                <label for="facebook">{{ __('admin.facebook')}}</label>
                                                <input type="url" class="form-control" id="facebook" name="facebook" value="{{$settings->facebook}}">
                                                @error('facebook')
                                                    <span class="text-danger">
                                                        <small class="errorTxt">{{ $message }}</small>
                                                    </span>
                                                @enderror
                                            </div>   
                                            <div class="col-md-6 col-12 mb-3">
                                                <label for="twitter">{{ __('admin.twitter')}}</label>
                                                <input type="url" class="form-control" id="twitter" name="twitter" value="{{$settings->twitter}}">
                                                @error('twitter')
                                                    <span class="text-danger">
                                                        <small class="errorTxt">{{ $message }}</small>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="col-md-6 col-12 mb-3">
                                                <label for="instagram">{{ __('admin.instagram')}}</label>
                                                <input type="url" class="form-control" id="instagram" name="instagram" value="{{$settings->instagram}}">
                                                @error('instagram')
                                                    <span class="text-danger">
                                                        <small class="errorTxt">{{ $message }}</small>
                                                    </span>
                                                @enderror
                                            </div>  
                                            <div class="col-md-6 col-12 mb-3">
                                                <label for="youtube">{{ __('admin.youtube')}}</label>
                                                <input type="url" class="form-control" id="youtube" name="youtube" value="{{$settings->youtube}}">
                                                @error('youtube')
                                                    <span class="text-danger">
                                                        <small class="errorTxt">{{ $message }}</small>
                                                    </span>
                                                @enderror
                                            </div>  
                                            <div class="col-md-6"></div>                                                                          
                                            @foreach (config('translatable.locales') as $locale)                                   
                                                <div class="col-md-6 col-12 mb-3">
                                                    <label for="{{$locale}}.privacy_page">{{ __('admin.'. $locale . '.privacy')}}</label>
                                                    <textarea class="form-control editor" id="privacy_page" name="{{$locale}}[privacy_page]">{{$settings->translate($locale)->privacy_page ?? ''}}</textarea>
                                                    @error($locale . '.privacy_page')
                                                        <span class="text-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>
                                            @endforeach  
                                                                                        
                                            @foreach (config('translatable.locales') as $locale)                                   
                                                <div class="col-md-6 col-12 mb-3">
                                                    <label for="{{$locale}}.terms_page">{{ __('admin.'. $locale . '.terms')}}</label>
                                                    <textarea class="form-control editor" id="terms_page" name="{{$locale}}[terms_page]">{{$settings->translate($locale)->terms_page ?? ''}}</textarea>
                                                    @error($locale . '.terms_page')
                                                        <span class="text-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>
                                            @endforeach            
                                            <div class="col-12">
                                                <button type="submit" class="btn btn-primary mr-1">{{ __('admin.save') }}</button>
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

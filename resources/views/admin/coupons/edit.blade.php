@extends('layouts.admin.app')

@section('title' ,  __('admin.edit_coupon'))

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
                                    <li class="breadcrumb-item"><a href="{{ route('admin.categories.index') }}">{{__('admin.coupons')}}</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">{{__('admin.edit_coupon')}}</a>
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
                                    <h2 class="card-title">{{ __('admin.edit_coupon') }}</h2>
                                </div>
                                <div class="card-body">
                                    <form class="form form-vertical needs-validation" action="{{ route('admin.coupons.update' , $coupon->id) }}" method="POST">                                    
                                        @method('PUT')
                                        @csrf
                                        <div class="row">
                             
                                            @foreach (config('translatable.locales') as $locale)                                   
                                                <div class="col-md-6 col-12 mb-3">
                                                    <label for="{{$locale}}.title">{{ __('admin.'. $locale . '.coupon_title')}}</label>
                                                    <input type="text" id="{{$locale}}.title" class="form-control" name="{{$locale}}[title]" value="{{$coupon->translate($locale)->title}}" required/>
                                                    @error($locale . '.title')
                                                        <span class="text-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>
                                            @endforeach 
                                                                                        
                                            <div class="col-md-6 col-12 mb-3">
                                                <label for="coupon_code">{{ __('admin.coupon_code') }}</label>
                                                <input type="text" id="coupon_code" class="form-control" name="coupon_code" value="{{ $coupon->coupon_code }}" required/>
                                                @error('coupon_code')
                                                    <span class="text-danger">
                                                        <small class="errorTxt">{{ $message }}</small>
                                                    </span>
                                                @enderror
                                            </div> 
                                                                                        
                                            <div class="col-md-6 col-12 mb-3">
                                                <label for="discount_type">{{ __('admin.discount_type')}}</label>
                                                <select name="discount_type" class="form-control" onchange="discocunt_type(this.value)">
                                                    <option value="">{{ __('admin.discount_type')}}</option>
                                                    <option value="amount" @selected($coupon->discount_type == 'amount')>{{ __('admin.amount')}}</option>
                                                    <option value="percentage" @selected($coupon->discount_type == 'percentage')>{{ __('admin.percentage')}}</option>
                                                </select>
                                            </div> 
                                                                              
                                            <div class="col-md-6 col-12 mb-3"  id="amount" style="{{ $coupon->discount_type !== 'amount' ? 'display: none' : '' }}">
                                                <label for="discount_amount">{{ __('admin.amount') }}</label>
                                                <input type="number" id="discount_amount" class="form-control" name="discount_amount" value="{{ $coupon->discount_amount }}"/>
                                                @error('discount_amount')
                                                    <span class="text-danger">
                                                        <small class="errorTxt">{{ $message }}</small>
                                                    </span>
                                                @enderror
                                            </div> 
                                                                                        
                                            <div class="col-md-6 col-12 mb-3"  id="percentage" style="{{ $coupon->discount_type !== 'percentage' ? 'display: none' : '' }}">
                                                <label for="discount_percentage">{{ __('admin.percentage') }}</label>
                                                <input type="number" id="discount_percentage" class="form-control" name="discount_percentage" value="{{ $coupon->discount_percentage }}"/>
                                                @error('discount_percentage')
                                                    <span class="text-danger">
                                                        <small class="errorTxt">{{ $message }}</small>
                                                    </span>
                                                @enderror
                                            </div> 
                                                                                        
                                            <div class="col-md-6 col-12 mb-3">
                                                <label for="coupon_usage_limit">{{ __('admin.coupon_usage_limit') }}</label>
                                                <input type="number" id="coupon_usage_limit" class="form-control" name="coupon_usage_limit" value="{{ $coupon->coupon_usage_limit }}"/>
                                                @error('coupon_usage_limit')
                                                    <span class="text-danger">
                                                        <small class="errorTxt">{{ $message }}</small>
                                                    </span>
                                                @enderror
                                            </div> 

                                            <div class="col-md-6 col-12 mb-3">
                                                <label for="minimum">{{ __('admin.minimum') }}</label>
                                                <input type="number" id="percentage" class="form-control" name="minimum" value="{{ $coupon->minimum }}"/>
                                                @error('minimum')
                                                    <span class="text-danger">
                                                        <small class="errorTxt">{{ $message }}</small>
                                                    </span>
                                                @enderror
                                            </div> 
                                                                                        
                                            <div class="col-md-6 col-12 mb-3">
                                                <label for="product_id">{{ __('admin.products') }}</label>
                                                <select name="product_id" class="form-control">
                                                    <option value="">{{ __('admin.choose_product') }}</option>
                                                    @foreach ($products as $product)
                                                        <option value="{{ $product->id }}" @selected($coupon->product_id == $product->id)>{{ $product->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                                                                                                                    
                                            <div class="col-md-6 col-12 mb-3">
                                                <label for="user_id">{{ __('admin.clients') }}</label>
                                                <select name="user_id" class="form-control">
                                                    <option value="">{{ __('admin.choose_client') }}</option>
                                                    @foreach ($clients as $client)
                                                        <option value="{{ $client->id }}" @selected($coupon->user_id == $client->id)>{{ $client->f_name . ' ' . $client->l_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                                                                        
                                            <div class="col-md-6 col-12 mb-3">
                                                <label for="start_date">{{ __('admin.start_date') }}</label>
                                                <input type="datetime-local" id="start_date" class="form-control" name="start_date" value="{{ str_replace(' ','T',$coupon->start_date) }}"/>
                                                @error('start_date')
                                                    <span class="text-danger">
                                                        <small class="errorTxt">{{ $message }}</small>
                                                    </span>
                                                @enderror
                                            </div> 
                                                                                        
                                            <div class="col-md-6 col-12 mb-3">
                                                <label for="end_date">{{ __('admin.end_date') }}</label>
                                                <input type="datetime-local" id="end_date" class="form-control" name="end_date" value="{{ str_replace(' ','T',$coupon->end_date) }}"/>
                                                @error('end_date')
                                                    <span class="text-danger">
                                                        <small class="errorTxt">{{ $message }}</small>
                                                    </span>
                                                @enderror
                                            </div> 
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

    @push('js')
    <script src="{{ asset('dashboard/assets/js/custom/validation/AdminForm.js') }}"></script>
    <script src="{{ asset('dashboard/app-assets/js/custom/preview-image.js') }}"></script>

    @endpush
@endsection

@extends('layouts.admin.app')

@section('title' , __('admin.edit_product'))

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
                                    <li class="breadcrumb-item"><a href="{{ route('admin.products.index') }}">{{ __('admin.products')}}</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">{{ __('admin.edit_product')}}</a>
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
                                    <h2 class="card-title">{{  __('admin.edit_product') }}</h2>
                                </div>
                                <div class="card-body">
                                    <form class="form form-vertical needs-validation" action="{{ route('admin.products.update' , $product->id) }}" method="POST" enctype="multipart/form-data">                                    
                                        @method('PUT')
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-12">           
                                                <label for="image">{{ __('admin.image')}}</label>
                                                <div class="uploadOuter">
                                                    <span class="dragBox" >
                                                        <i class="fa fa-cloud-upload-alt fa-2x"></i>
                                                        <input type="file" name="image" onChange="dragNdrop(event)"  ondragover="drag()" ondrop="drop()" id="uploadFile"  />
                                                    </span>
                                                </div>
                                                <div id="preview">
                                                    <img src="{{asset($product->image_path)}}" class="imgPreview img-thumbnail">
                                                </div>
                                            </div>
                                                                                       
                                            @foreach (config('translatable.locales') as $locale)
                                                                                            
                                                <div class="col-md-6 col-12 mb-3">
                                                    <label for="{{$locale}}.name">{{ __('admin.'. $locale . '.product_name')}}</label>
                                                    <input type="text" id="{{$locale}}.name" class="form-control" name="{{$locale}}[name]" value="{{$product->translate($locale)->name}}" required/>

                                                    @error($locale . '.name')
                                                        <span class="text-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>
                                            @endforeach
                                                                                        
                                            @foreach (config('translatable.locales') as $locale)                                   
                                                <div class="col-md-6 col-12 mb-3">
                                                    <label for="{{$locale}}.desc">{{ __('admin.'. $locale . '.product_desc')}}</label>
                                                    <textarea  id="{{$locale}}.desc" class="form-control" name="{{$locale}}[desc]" required>{{$product->translate($locale)->desc}}</textarea>
                                                    @error($locale . '.desc')
                                                        <span class="text-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>
                                            @endforeach 
                                            <div class="col-md-6 col-12 mb-3">
                                                <label for="category_id">{{ __('admin.category') }}</label>
                                                <select name="category_id" class="form-control" required>
                                                    <option value="">{{ __('admin.choose_category') }}</option>
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}" @selected($category->id == $product->category_id)>{{ $category->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="col-md-6 col-12 mb-3">
                                                <label for="price">{{ __('admin.price') }}</label>
                                                <input type="number" id="price" class="form-control" name="price" value="{{ $product->price }}" required/>
                                                @error('price')
                                                    <span class="text-danger">
                                                        <small class="errorTxt">{{ $message }}</small>
                                                    </span>
                                                @enderror
                                            </div>                          
                                            <div class="col-md-6 col-12 mb-3">
                                                <label for="discount_price">{{ __('admin.discount_price') }}</label>
                                                <input type="number" id="discount_price" class="form-control" name="discount_price" value="{{ $product->discount_price }}" />
                                                @error('discount_price')
                                                    <span class="text-danger">
                                                        <small class="errorTxt">{{ $message }}</small>
                                                    </span>
                                                @enderror
                                            </div>                                     
                                            <div class="col-md-6 col-12 mb-3">
                                                <label for="car_type_id">{{ __('admin.car_type') }}</label>
                                                <select name="car_type_id" class="form-control" required>
                                                    <option value="">{{ __('admin.choose_car_type') }}</option>
                                                    @foreach ($car_types as $car_type)
                                                        <option value="{{ $car_type->id }}" @selected($car_type->id == $product->car_type_id)>{{ $car_type->type }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-6 col-12 mb-3">
                                                <label for="car_model_ids[]">{{ __('admin.car_models')}}</label>                                 
                                                <select name="car_model_ids[]" class="select2 form-control" multiple required>
                                                    <option value="" disabled>{{ __('admin.choose_car_model') }}</option>
                                                    @foreach ($car_models as $car_model)
                                                        <option value="{{ $car_model->id }}" @selected(in_array($car_model->id, $product->car_models()->pluck('car_model_id')->toArray()))>{{ $car_model->model }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                           <div class="col-md-6 col-12 mb-3">
                                                <label for="manufacture_country">{{ __('admin.manufacture_country')}}</label>
                                                <input type="text" id="manufacture_country" class="form-control" name="manufacture_country" value="{{ $product->manufacture_country}}" />
                                                @error('manufacture_country')
                                                    <span class="text-danger">
                                                        <small class="errorTxt">{{ $message }}</small>
                                                    </span>
                                                @enderror
                                            </div> 
                                            <div class="col-md-6 col-12 mb-3">
                                                <label for="type">الصنع</label>
                                                <select name="type" class="form-control" required>
                                                    <option value="">{{ __('admin.made_type')}}</option>
                                                    <option value="original" @selected($product->type == 'original')>{{ __('admin.original') }}</option>
                                                    <option value="high-copy" @selected($product->type == 'high-copy')>{{ __('admin.high_copy') }}</option>
                                                    <option value="copy" @selected($product->type == 'copy')>{{ __('admin.copy') }}</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6 col-12 mb-3">
                                                <label for="manufacturing_year">{{ __('admin.manufacturing_year') }}</label>
                                                <select name="manufacturing_year" class="form-control" required>
                                                    <option value="">{{ __('admin.choose_manufacturing_year') }}</option>
                                                    @for ($i = now()->year-20; $i <= now()->year; $i++)
                                                        <option value="{{$i}}" @selected($product->manufacturing_year == $i)>{{ $i}}</option>
                                                    @endfor
                                                    
                                                </select>
                                            </div>                                                                                                  
                                            <div class="features col-12 mb-3">
                                                <button type="button" class="btn btn-secondary add-feature">
                                                    <span><i class="fa fa-plus"></i></span>
                                                    <span>{{ __('admin.add_product_features') }}</span>
                                                </button>
                                                                                                                            
                                                <input type="hidden" name="ar[features]" value="" />                                                                                                        
                                                <input type="hidden" name="en[features]" value="" />                                                                                                        

                                                @if ($product->features)

                                                    @foreach ($product->features as $key=>$feature)
                                                        <div class="parent-feature">
                                                            <div class="row">  
                                                                @foreach (config('translatable.locales') as $locale)                  
                                                                    <div class="col-md-6 col-12">
                                                                        <div class="sub-main-feature mt-1">
                                                                            <label>{{ __('admin.'. $locale . '.product_feature')}}</label>
                                                                            <input type="text" id="features" class="form-control" name="{{$locale}}[features][]"
                                                                                    value="{{ $product->translate($locale)->features[$key] }}" required/>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                            <div class="remove-input-feature delete-btn" style="cursor:pointer">
                                                                <span> <i class="fa fa-trash fa-sm"></i> </span>
                                                            </div>
                                                        </div>
                                                    @endforeach 

                                                @endif

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

@section('js')

    <script>

        // ======================================== Features =========================================================
            $(document).on("click" , ".add-feature", function(){
                $(".features").append(
                    `
                    <div class="parent-feature">
                        <div class="row">                                       
                            @foreach (config('translatable.locales') as $locale)                                   
                                <div class="col-md-6 col-12">
                                    <div class="sub-main-feature mt-1">
                                        <label>{{ __('admin.'. $locale . '.product_feature')}}</label>
                                        <input type="text" id="features" class="form-control" name="{{$locale}}[features][]"
                                                value="{{ old('features') }}" required/>
                                    </div>
                                </div>
                            @endforeach
                        </div>                                                      
                        <div class="remove-input-feature delete-btn" style="cursor:pointer">
                            <span> <i class="fa fa-trash fa-sm"></i> </span>
                        </div>
                    </div>
                    `
                )

            });

                    
            $(document).on('click' , ".remove-input-feature" , function(){
                $(this).parent(".parent-feature").remove();
            });


    </script>

@endsection


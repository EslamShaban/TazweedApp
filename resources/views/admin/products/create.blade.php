@extends('layouts.admin.app')

@section('title' , 'أضف منتج')

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
                                    <li class="breadcrumb-item"><a href="{{ route('admin.products.index') }}">المنتجات</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">أضف منتج</a>
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
                                    <h2 class="card-title">أضف منتج</h2>
                                </div>
                                <div class="card-body">
                                    <form class="form form-vertical needs-validation" action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row"> 
                                            <div class="col-md-12">           
                                                <label for="image">الصورة</label>
                                                <div class="uploadOuter">
                                                    <span class="dragBox" >
                                                        <i class="fa fa-cloud-upload-alt fa-2x"></i>
                                                        <input type="file" name="image" onChange="dragNdrop(event)"  ondragover="drag()" ondrop="drop()" id="uploadFile"  />
                                                    </span>
                                                </div>
                                                <div id="preview"></div>
                                            </div>
                                            <div class="col-md-6 col-12 mb-3">
                                                <label for="name">إسم المنتج</label>
                                                <input type="text" id="name" class="form-control" name="name" value="{{ old('name') }}" required/>
                                                @error('name')
                                                    <span class="text-danger">
                                                        <small class="errorTxt">{{ $message }}</small>
                                                    </span>
                                                @enderror
                                            </div>                          
                                            <div class="col-md-6 col-12 mb-3">
                                                <label for="category_id">القسم</label>
                                                <select name="category_id" class="form-control" required>
                                                    <option value="">أختر القسم</option>
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}" @selected($category->id == old('category_id'))>{{ $category->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-12 mb-3">
                                                <label for="name">وصف المنتج</label>
                                                <textarea  id="desc" class="form-control" name="desc" required>{{ old('desc') }}</textarea>
                                                @error('desc')
                                                    <span class="text-danger">
                                                        <small class="errorTxt">{{ $message }}</small>
                                                    </span>
                                                @enderror
                                            </div>  
                                            <div class="col-md-6 col-12 mb-3">
                                                <label for="price">السعر</label>
                                                <input type="number" id="price" class="form-control" name="price" value="{{ old('price') }}" required/>
                                                @error('price')
                                                    <span class="text-danger">
                                                        <small class="errorTxt">{{ $message }}</small>
                                                    </span>
                                                @enderror
                                            </div>                          
                                            <div class="col-md-6 col-12 mb-3">
                                                <label for="discount_price">سعر الخصم</label>
                                                <input type="number" id="discount_price" class="form-control" name="discount_price" value="{{ old('discount_price') }}" />
                                                @error('discount_price')
                                                    <span class="text-danger">
                                                        <small class="errorTxt">{{ $message }}</small>
                                                    </span>
                                                @enderror
                                            </div>                                     

                                            <div class="col-md-6 col-12 mb-3">
                                                <label for="car_type_id">نوع السيارة</label>
                                                <select name="car_type_id" class="form-control" required>
                                                    <option value="">أختر نوع السيارة</option>
                                                    @foreach ($car_types as $car_type)
                                                        <option value="{{ $car_type->id }}" @selected($car_type->id == old('car_type_id'))>{{ $car_type->type }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-6 col-12 mb-3">
                                                <label for="car_model_ids[]">الموديلات</label>                                 
                                                <select name="car_model_ids[]" class="select2 form-control" multiple required>
                                                    <option value="" disabled>أختر الموديلات </option>
                                                    @foreach ($car_models as $car_model)
                                                        <option value="{{ $car_model->id }}">{{ $car_model->model }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                                                                           
                                            <div class="col-md-4 col-12 mb-3">
                                                <label for="manufacture_country">بلد المصنع</label>
                                                <input type="text" id="manufacture_country" class="form-control" name="manufacture_country" value="{{ old('manufacture_country') }}" />
                                                @error('manufacture_country')
                                                    <span class="text-danger">
                                                        <small class="errorTxt">{{ $message }}</small>
                                                    </span>
                                                @enderror
                                            </div> 
                                            <div class="col-md-4 col-12 mb-3">
                                                <label for="type">الصنع</label>
                                                <select name="type" class="form-control" required>
                                                    <option value="">أختر نوع الصنع</option>
                                                    <option value="original" >أصلي</option>
                                                    <option value="high-copy">تقليد بجوده عالية</option>
                                                    <option value="copy">تقليد</option>
                                                </select>
                                            </div>
                                            <div class="col-md-4 col-12 mb-3">
                                                <label for="manufacturing_year">سنة الصنع</label>
                                                <select name="manufacturing_year" class="form-control" required>
                                                    <option value="">أختر سنة الصنع</option>
                                                    @for ($i = now()->year-20; $i <= now()->year; $i++)
                                                        <option value="{{$i}}">{{ $i}}</option>
                                                    @endfor
                                                    
                                                </select>
                                            </div>                                     
                                            <div class="features col-12 mb-3">
                                                <button type="button" class="btn btn-secondary add-feature">
                                                    <span><i class="fa fa-plus"></i></span>
                                                    <span> أضف مميزات للمنتج </span>
                                                </button>
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
                        <div class="col-md-11 col-12 parent-feature">

                            <div class="sub-main-feature mt-1">
                                <input type="text" id="features" class="form-control" name="features[]"
                                        value="{{ old('features') }}" required/>
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

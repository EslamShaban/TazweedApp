@extends('layouts.admin.app')

@section('title' , 'تعديل الكابتن')

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
                                    <li class="breadcrumb-item"><a href="{{ route('admin.captains.index') }}">الكابتن</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">تعديل الكابتن</a>
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
                                    <h2 class="card-title">تعديل الكابتن</h2>
                                </div>
                                <div class="card-body">
                                    <form class="form form-vertical needs-validation" action="{{ route('admin.captains.update' , $captain->id) }}" method="POST" enctype="multipart/form-data">                                    
                                        @method('PUT')
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
                                                <div id="preview">
                                                    <img src="{{asset($captain->image_path)}}" class="imgPreview img-thumbnail">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12 mb-3">
                                                <label for="f_name">الإسم الاول</label>
                                                <input type="text" id="f_name" class="form-control" name="f_name" value="{{ old('f_name', $captain->f_name) }}" required/>
                                                @error('f_name')
                                                    <span class="text-danger">
                                                        <small class="errorTxt">{{ $message }}</small>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="col-md-6 col-12 mb-3">
                                                <label for="l_name">الإسم الاخير</label>
                                                <input type="text" id="l_name" class="form-control" name="l_name" value="{{ old('l_name', $captain->l_name) }}" required/>
                                                @error('l_name')
                                                    <span class="text-danger">
                                                        <small class="errorTxt">{{ $message }}</small>
                                                    </span>
                                                @enderror
                                            </div>                          
                                            <div class="col-md-6 col-12 mb-3">
                                                <label for="email">البريد الإلكتروني</label>
                                                <input type="email" id="email" class="form-control" name="email" value="{{ old('email', $captain->email) }}" required/>
                                                @error('email')
                                                    <span class="text-danger">
                                                        <small class="errorTxt">{{ $message }}</small>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="col-md-6 col-12 mb-3">
                                                <label for="phone">رقم الهاتف</label>
                                                <input type="text" id="phone" class="form-control" name="phone" value="{{ old('phone', $captain->phone) }}" required/>
                                                @error('phone')
                                                    <span class="text-danger">
                                                        <small class="errorTxt">{{ $message }}</small>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="col-md-6 col-12 mb-3">
                                                <label for="password">كلمة المرور</label>
                                                <input type="password" id="password" class="form-control" name="password" value="{{ old('password') }}"/>
                                                @error('password')
                                                    <span class="text-danger">
                                                        <small class="errorTxt">{{ $message }}</small>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="col-md-6 col-12 mb-3">
                                                <label for="city_id">المحافظة</label>
                                                <select name="city_id" class="form-control" required>
                                                    <option value="">أختر المحافظة</option>
                                                    @foreach (\App\Models\City::all() as $city)
                                                        <option value="{{ $city->id }}" {{ $captain->city_id == $city->id ? 'selected' : ''}}>{{ $city->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                                <div class="col-md-12">
                                                    <h2 class="card-title">بيانات السيارة</h2>
                                                <hr>
                                                                                            
                                                <div class="col-md-6 col-12 mb-3 mt-2">
                                                    <label for="plate_number" class="form-label">رقم اللوحة </label>
                                                    <input type="text" id="plate_number" class="form-control" name="plate_number" value="{{ old('plate_number', $captain->car->plate_number) }}" required/>
                                                    @error('plate_number')
                                                        <span class="text-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>
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

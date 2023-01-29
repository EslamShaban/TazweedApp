@extends('layouts.admin.app')

@section('title' , 'تعديل الخدمة')

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
                                    <li class="breadcrumb-item"><a href="{{ route('admin.services.index') }}">الأقسام</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">تعديل الخدمة</a>
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
                                    <h2 class="card-title">تعديل الخدمة</h2>
                                </div>
                                <div class="card-body">
                                    <form class="form form-vertical needs-validation" action="{{ route('admin.services.update' , $service->id) }}" method="POST" enctype="multipart/form-data">                                    
                                        @method('PUT')
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-12 mb-3">
                                                <label for="name">إسم الخدمة</label>
                                                    <input type="text" id="name" class="form-control" name="name"
                                                        value="{{ old('name' , $service->name) }}" required/>

                                                    @error('name')
                                                        <span class="text-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                            </div>
                                            <div class="col-md-12">           
                                                <label for="image">الصورة</label>
                                                <div class="uploadOuter">
                                                    <span class="dragBox" >
                                                        <i class="fa fa-cloud-upload-alt fa-2x"></i>
                                                        <input type="file" name="image" onChange="dragNdrop(event)"  ondragover="drag()" ondrop="drop()" id="uploadFile"  />
                                                    </span>
                                                </div>
                                                <div id="preview">
                                                    <img src="{{asset($service->image_path)}}" class="imgPreview img-thumbnail">
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

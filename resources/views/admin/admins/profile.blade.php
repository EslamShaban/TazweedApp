@extends('layouts.admin.app')

@section('title' , __('admin.profile'))

@section('content')

    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-body">
                <!-- account setting page -->
                <section id="page-account-settings">
                    <div class="row">

                        <!-- right content section -->
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="tab-content">
                                        <!-- general tab -->
                                        <div role="tabpanel" class="tab-pane active" id="account-vertical-general"
                                            aria-labelledby="account-pill-general" aria-expanded="true">

                                            <!-- form -->
                                            <form class="form form-vertical" id="profileForm"
                                                action="{{ route('admin.update_profile') }}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-md-12">           
                                                        <label for="image">{{ __('admin.image') }}</label>
                                                        <div class="uploadOuter">
                                                            <span class="dragBox" >
                                                                <i class="fa fa-cloud-upload-alt fa-2x"></i>
                                                                <input type="file" name="image" onChange="dragNdrop(event)"  ondragover="drag()" ondrop="drop()" id="uploadFile"  />
                                                            </span>
                                                        </div>
                                                        <div id="preview">
                                                            <img src="{{asset($admin->image_path)}}" class="imgPreview img-thumbnail">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-12 mb-3">
                                                        <label for="f_name">{{ __('admin.f_name')}}</label>
                                                        <input type="text" id="f_name" class="form-control" name="f_name" value="{{ old('f_name', $admin->f_name) }}" required/>
                                                        @error('f_name')
                                                            <span class="text-danger">
                                                                <small class="errorTxt">{{ $message }}</small>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-6 col-12 mb-3">
                                                        <label for="l_name"> {{ __('admin.l_name') }} </label>
                                                        <input type="text" id="l_name" class="form-control" name="l_name" value="{{ old('l_name', $admin->l_name) }}" required/>
                                                        @error('l_name')
                                                            <span class="text-danger">
                                                                <small class="errorTxt">{{ $message }}</small>
                                                            </span>
                                                        @enderror
                                                    </div>                          
                                                    <div class="col-md-6 col-12 mb-3">
                                                        <label for="email">{{ __('admin.email') }}</label>
                                                        <input type="email" id="email" class="form-control" name="email" value="{{ old('email', $admin->email) }}" required/>
                                                        @error('email')
                                                            <span class="text-danger">
                                                                <small class="errorTxt">{{ $message }}</small>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-6 col-12 mb-3">
                                                        <label for="password">{{ __('admin.password')}}</label>
                                                        <input type="password" id="password" class="form-control" name="password" value="{{ old('password') }}"/>
                                                        @error('password')
                                                            <span class="text-danger">
                                                                <small class="errorTxt">{{ $message }}</small>
                                                            </span>
                                                        @enderror
                                                    </div>

                                                    <div class="col-12">
                                                        <button type="submit"
                                                            class="btn btn-primary mr-1">تعديل</button>
                                                    </div>
                                                </div>
                                            </form>
                                            <!--/ form -->
                                        </div>
                                        <!--/ general tab -->

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--/ right content section -->
                    </div>
                </section>
                <!-- / account setting page -->
            </div>
        </div>
    </div>
    <!-- END: Content-->

    @push('js')
        <script src="{{ asset('dashboard/assets/js/custom/validation/profileForm.js') }}"></script>
    @endpush


@endsection

@extends('layouts.admin.app')

@section('title' , __('admin.add_question'))

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
                                    <li class="breadcrumb-item"><a href="{{ route('admin.questions.index') }}">{{ __('admin.questions') }}</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">{{ __('admin.add_question') }}</a>
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
                                    <h2 class="card-title">{{ __('admin.add_question') }}</h2>
                                </div>
                                <div class="card-body">
                                    <form class="form form-vertical needs-validation" action="{{ route('admin.questions.store') }}" method="POST" >
                                        @csrf
                                        <div class="row">                         
                                            @foreach (config('translatable.locales') as $locale)                                   
                                                <div class="col-md-6 col-12 mb-3">
                                                    <label for="{{$locale}}.question">{{ __('admin.'. $locale . '.question')}}</label>
                                                    <input type="text" id="{{$locale}}.question" class="form-control" name="{{$locale}}[question]" value="{{old($locale . '.question')}}" />
                                                    @error($locale . '.question')
                                                        <span class="text-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>
                                            @endforeach 
                                                                                                    
                                            <div class="col-md-6 col-12 mb-3">
                                                <label for="questionable_type">{{ __('admin.question_type')}}</label>
                                                <select name="questionable_type" class="form-control" onchange="question_type(this.value)">
                                                    <option value="">{{ __('admin.question_type')}}</option>
                                                    <option value="category" @selected(old('questionable_type') == 'category')>{{ __('admin.category')}}</option>
                                                    <option value="service" @selected(old('questionable_type') == 'service')>{{ __('admin.service')}}</option>
                                                </select>                                                
                                                @error('questionable_type')
                                                    <span class="text-danger">
                                                        <small class="errorTxt">{{ $message }}</small>
                                                    </span>
                                                @enderror
                                            </div> 
                                                                                                        
                                            <div class="col-md-6 col-12 mb-3"  id="category" style="{{ old('questionable_type') !== 'category' ? 'display: none' : '' }}">
                                                <label for="questionable_id">{{ __('admin.category') }}</label>                                                                                                
                                                <select name="questionable_id" class="form-control"  id="category_questionable_id">
                                                    <option value="">{{ __('admin.category')}}</option>
                                                    @foreach (\App\Models\Category::all() as $category)
                                                        <option value="{{ $category->id }}" @selected(old('questionable_id') == $category->id)>{{ $category->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('questionable_id')
                                                    <span class="text-danger">
                                                        <small class="errorTxt">{{ $message }}</small>
                                                    </span>
                                                @enderror
                                            </div> 
                                            <div class="col-md-6 col-12 mb-3"  id="service" style="{{ old('questionable_type') !== 'service' ? 'display: none' : '' }}">
                                                <label for="questionable_id">{{ __('admin.service') }}</label>                                                                                                
                                                <select name="questionable_id" class="form-control" id="service_questionable_id">
                                                    <option value="">{{ __('admin.service')}}</option>
                                                    @foreach (\App\Models\Service::all() as $service)
                                                        <option value="{{ $service->id }}" @selected(old('questionable_id') == $service->id)>{{ $service->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('questionable_id')
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
@endsection

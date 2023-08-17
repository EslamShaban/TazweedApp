@extends('layouts.admin.app')

@section('title' , __('admin.edit_offer'))

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
                                    <li class="breadcrumb-item"><a href="{{ route('admin.offers.index') }}">{{ __('admin.offers') }}</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">{{ __('admin.edit_offer') }}</a>
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
                                    <h2 class="card-title">{{ __('admin.edit_offer') }}</h2>
                                </div>
                                <div class="card-body">
                                    <form class="form form-vertical needs-validation" action="{{ route('admin.offers.update' , $offer->id) }}" method="POST" enctype="multipart/form-data">
                                        @method('PUT')
                                        @csrf
                                        <div class="row">
                                            @foreach (config('translatable.locales') as $locale)

                                                <div class="col-md-6 col-12 mb-3">
                                                    <label for="{{$locale}}.name">{{ __('admin.'. $locale . '.offer_name')}}</label>
                                                    <input type="text" id="{{$locale}}.name" class="form-control" name="{{$locale}}[name]" value="{{$offer->translate($locale)->name}}" required/>

                                                    @error($locale . '.name')
                                                        <span class="text-danger">
                                                            <small class="errorTxt">{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>
                                            @endforeach

                                            <div class="col-md-6 col-12 mb-3">
                                                <label for="start_date">{{ __('admin.start_date') }}</label>
                                                <input type="datetime-local" id="start_date" class="form-control" name="start_date" value="{{ $offer->start_date }}" required/>
                                                @error('start_date')
                                                    <span class="text-danger">
                                                        <small class="errorTxt">{{ $message }}</small>
                                                    </span>
                                                @enderror
                                            </div>

                                            <div class="col-md-6 col-12 mb-3">
                                                <label for="end_date">{{ __('admin.end_date') }}</label>
                                                <input type="datetime-local" id="end_date" class="form-control" name="end_date" value="{{ $offer->end_date }}" required/>
                                                @error('end_date')
                                                    <span class="text-danger">
                                                        <small class="errorTxt">{{ $message }}</small>
                                                    </span>
                                                @enderror
                                            </div>

                                            <div class="col-md-6 col-12 mb-3">
                                                <label for="discount_type">{{ __('admin.discount_type')}}</label>
                                                <select name="discount_type" class="form-control"  required>
                                                    <option value="">{{ __('admin.discount_type')}}</option>
                                                    <option value="amount" @selected($offer->discount_type == 'amount')>{{ __('admin.amount')}}</option>
                                                    <option value="percentage" @selected($offer->discount_type == 'percentage')>{{ __('admin.percentage')}}</option>
                                                </select>
                                            </div>

                                            <div class="col-md-6 col-12 mb-3"   >
                                                <label for="discount_amount">{{ __('admin.amount') }}</label>
                                                <input type="number" id="discount_amount" class="form-control" name="discount_amount" value="{{ $offer->discount_amount }}" required/>
                                                @error('discount_amount')
                                                    <span class="text-danger">
                                                        <small class="errorTxt">{{ $message }}</small>
                                                    </span>
                                                @enderror
                                            </div>

                                            <div class="col-md-6 col-12 mb-3">
                                                <label for="model_type">{{ __('admin.model_type')}}</label>
                                                <select name="model_type" class="form-control" required>
                                                    <option value="">{{ __('admin.model_type')}}</option>
                                                    <option value="category" @selected($model_type == 'category')>{{ __('admin.category')}}</option>
                                                    <option value="product" @selected($model_type == 'product')>{{ __('admin.product')}}</option>
                                                </select>
                                            </div>

                                            <div class="col-md-6 col-12 mb-3">
                                                <label for="model_id">{{ __('admin.model_id')}}</label>
                                                <select name="model_id[]" class="select2 form-control" multiple required>
                                                    @foreach ($models as $model)
                                                        <option value="{{ $model->id }}" @selected(in_array($model->id, $modelsIds))>{{ $model->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

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
@section('js')
<script type="text/javascript">
    var defaultOption = document.createElement('option');
        defaultOption.innerHTML = "{{ __('lang.select_one') }}";
        $(document).ready(function() {
            $('select[name="model_type"]').on('change', function() {
                var model_type = $(this).val();
                console.log(model_type);
                if (model_type == "category") {
                    $.ajax({
                        url: "{{ route('admin.offers.getAllCategories') }}",
                        type: "GET",
                        dataType: "json",
                        success: function(response) {
                            $('select[name="model_id[]"]').empty();
                            $('select[name="model_id[]"]').append(defaultOption);
                            console.log(response.categories);
                            $.each(response.categories, function(key, item) {
                                $('select[name="model_id[]"]').append('<option value="' +
                                    item.id + '">' + item.name + '  ' + '</option>');
                            });
                        },
                    });

                } else if (model_type == "product") {
                    $.ajax({
                        url: "{{ route('admin.offers.getAllProducts') }}",
                        type: "GET",
                        dataType: "json",
                        success: function(response) {
                            $('select[name="model_id[]"]').empty();
                            $('select[name="model_id[]"]').append(defaultOption);
                            console.log(response.products);
                            $.each(response.products, function(key, item) {
                                $('select[name="model_id[]"]').append('<option value="' +
                                    item.id + '">' + item.name +  '</option>');
                            });
                        },
                    });
                } else {
                    console.log('AJAX load did not work');
                }
            });
        });
</script>
@endsection

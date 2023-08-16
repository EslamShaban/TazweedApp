@extends('layouts.admin.app')

@section('title', __('admin.add_product'))

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
                                    <li class="breadcrumb-item"><a
                                            href="{{ route('admin.products.index') }}">{{ __('admin.products') }}</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">{{ __('admin.add_product') }}</a>
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
                                    <h2 class="card-title">{{ __('admin.add_product') }}</h2>
                                </div>
                                <div class="card-body">
                                    <form class="form form-vertical needs-validation"
                                        action="{{ route('admin.store_product_attributes') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <input type="hidden" value="{{ $product_id }}" name="product_id">

                                            @php
                                                $i = 0;
                                            @endphp
                                            @forelse($attributes as $attribute)
                                                <div class="row">
                                                    <div class="col-sm-3 col-md-12">
                                                        <div class="form-group">
                                                            <label for="variant{{ $i }}"
                                                                class="col-form-label">{{ $attribute->name }}</label>
                                                            <select name="super_attributes[{{ $i }}][]"
                                                                class="select2 form-control " multiple
                                                                id="variant{{ $i }}">
                                                                <option>{{ trans('messages.select_ingredients') }}</option>
                                                                @forelse ($attribute->attributevalue as $value)
                                                                    <option value="{{ $value->id }}">
                                                                        {{ $value->getTranslation('name', 'en') }}
                                                                    </option>
                                                                @empty
                                                                @endforelse
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                @php
                                                    $i++;
                                                @endphp
                                            @empty
                                            @endforelse

                                            <div class="col-12">
                                                <button type="submit"
                                                    class="btn btn-primary mr-1">{{ __('admin.save') }}</button>
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
        $(document).on("click", ".add-feature", function() {
            $(".features").append(
                `
                    <div class="parent-feature">
                        <div class="row">
                            @foreach (config('translatable.locales') as $locale)
                                <div class="col-md-6 col-12">
                                    <div class="sub-main-feature mt-1">
                                        <label>{{ __('admin.' . $locale . '.product_feature') }}</label>
                                        <input type="text" id="features" class="form-control" name="{{ $locale }}[features][]"
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


        $(document).on('click', ".remove-input-feature", function() {
            $(this).parent(".parent-feature").remove();
        });
    </script>

@endsection

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
                                    @php
                                        $its_id = implode('/', array_slice(request()->segments(), 2));
                                    @endphp
                                    <form class="form form-vertical needs-validation"
                                        action="{{ route('admin.store_product_variants') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <input type="hidden" value="{{ $its_id }}" name="its_id">
                                            @php
                                                $i = 0;
                                            @endphp

                                            <table class="col-12">
                                                @if (isset($product_data[0]->id))
                                                    <tr style="text-align: center;">
                                                        <td> Name </td>
                                                        <td> SKU </td>
                                                        <td> Quantity </td>
                                                        <td> Price </td>
                                                        <td> Image </td>
                                                        <td> </td>
                                                        <td colspan="2">
                                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Delete
                                                        </td>
                                                    </tr>
                                                @endif
                                                @forelse($product_data as $single_product)
                                                    <tr class="mb-3">
                                                        <td> <input id="sku" type="text"
                                                                value="{{ $single_product->name }}" disabled> </td>
                                                        <td> <input id="sku" type="text"
                                                                value="{{ $single_product->sku }}" disabled> </td>
                                                        <input id="sku" type="hidden"
                                                            value="{{ $single_product->sku }}"
                                                            name="sku[{{ $i }}]">
                                                        <td> <input id="quantity" value="{{ $single_product->quantity }}"
                                                                type="number" min="0" step="any"
                                                                name="quantity[{{ $i }}]" required></td>
                                                        <td> <input id="price" value="{{ $single_product->price }}"
                                                                type="number" min="1" step="any"
                                                                name="price[{{ $i }}]" required></td>
                                                        <td> <input type="file" name="image[{{ $i }}]"
                                                                id="image" accept="image/*"
                                                                @if (!$single_product->image) required @endif> </td>
                                                        <td colspan="2">
                                                            @if ($single_product->image)
                                                                <a target="_blank"
                                                                    href="{{ Storage::disk('public')->url('/images/product/' . $single_product->image) }}"><img
                                                                        style="width: 30px"
                                                                        src="{{ Storage::disk('public')->url('/images/product/' . $single_product->image) }}"></a>
                                                            @endif
                                                        </td>
                                                        <td colspan="2"> <a
                                                                href="{{ route('admin.delete_product_variant', $single_product->id) }}"
                                                                alt="delete" title="delete">X</a> </td>

                                                    </tr>

                                                    @php
                                                        $i++;
                                                    @endphp
                                                @empty
                                                    <tr style="text-align: center;">
                                                        <td> Quantity
                                        </div>
                                        <td> Price </td>
                                        </tr>
                                        <tr>
                                            <td> <input id="product_quantity" value="{{ $main_product_data->quantity }}"
                                                    type="number" min="0" step="any" name="product_quantity"
                                                    required></td>
                                            <td> <input id="product_price" value="{{ $main_product_data->price }}"
                                                    type="number" min="1" step="any" name="product_price"
                                                    required>
                                            </td>
                                        </tr>
                                        @endforelse
                                        </table>

                                        <div class="col-12 mt-2">
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

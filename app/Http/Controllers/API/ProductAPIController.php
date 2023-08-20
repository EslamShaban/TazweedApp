<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\AttributeResource;
use App\Http\Resources\BrandResource;
use App\Http\Resources\OfferResource;
use Illuminate\Http\Request;
use App\Repositories\ProductRepository;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ProductDetailsResource;
use App\Models\Attribute;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use App\Models\Offer;

class ProductAPIController extends Controller
{

    private  $productRepository;

    public function __construct(ProductRepository $product)
    {
        $this->productRepository = $product;
    }

    // get all products
    public function get_all_products()
    {
        $products = $this->productRepository->all();

        return response()->withData(__('api.all_products'), ['products' => ProductResource::collection($products)]);
    }

    // get product details
    public function product_details($id)
    {
        $product = $this->productRepository->find($id);

        if(!$product){
            return response()->withError(__('api.product_not_found'), 5001, 'product_id');
        }

        return response()->withData(__('api.product_detail'), ['product' => new ProductDetailsResource($product)]);

    }

    // get all offers
    public function get_all_offers()
    {
        $offers = Product::Offers()->latest()->get();

        return response()->withData(__('api.all_offers'), ['offers' => ProductResource::collection($offers)]);
    }

    // get all offers
    public function get_multi_offers()
    {
        $offers = Offer::with('offerDetails')->latest()->get();

        return response()->withData(__('api.all_offers'), ['offers' => OfferResource::collection($offers)]);
    }

    // get all offers
    public function get_all_brands()
    {
        $brands = Brand::latest()->get();

        return response()->withData(__('api.all_brands'), ['brands' => BrandResource::collection($brands)]);
    }

    // get all offers
    public function get_all_attributes()
    {
        $attributes = Attribute::latest()->get();

        return response()->withData(__('api.all_attributes'), ['attributes' => AttributeResource::collection($attributes)]);
    }

    public function category_products($id)
    {
        $category = Category::find($id);

        if(!$category){
            return response()->withError(__('api.category_not_found'), 5001, 'category_id');
        }

        return response()->withData(__('api.category_products'), ['products' => ProductResource::collection($category->products)]);

    }

}

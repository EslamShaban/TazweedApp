<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\ProductRepository;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ProductDetailsResource;
use App\Models\Product;

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

        return response()->withData('كافة المنتجات', ['products' => ProductResource::collection($products)]);
    }

    // get product details
    public function product_details($id)
    {
        $product = $this->productRepository->find($id);
                
        if(!$product){
            return response()->withError('المنتج غير موجود', 5001, 'product_id');
        }

        return response()->withData('تفاصيل المنتج', ['product' => new ProductDetailsResource($product)]);

    }

    // get all offers
    public function get_all_offers()
    {
        $offers = Product::Offers()->latest()->get();

        return response()->withData('كافة العروض ', ['offers' => ProductResource::collection($offers)]);
    }

}

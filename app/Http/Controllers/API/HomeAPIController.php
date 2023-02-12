<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\CategoryRepository;
use App\Repositories\ProductRepository;
use App\Repositories\ServiceRepository;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ServiceResource;
use App\Models\Product;

class HomeAPIController extends Controller
{

    private $categoryRepository, $productRepository, $serviceRepository;
    
    public function __construct(
        CategoryRepository $category, 
        ProductRepository $product, 
        ServiceRepository $service
    )
    {
        $this->categoryRepository = $category;
        $this->productRepository = $product;
        $this->serviceRepository = $service;

    }

    public function home()
    {
        
        $categories = $this->categoryRepository->all();
        $products = $this->productRepository->all();
        $offers = Product::Offers()->latest()->take(3)->get();
        $services = $this->serviceRepository->all();
        
        $data = [
            'categories'  => CategoryResource::collection($categories), 
            'offers'      => ProductResource::collection($offers), 
            'products'    => ProductResource::collection($products), 
            'services'    => ServiceResource::collection($services)  
        ];

        return response()->withData(__('api.home'), $data);

    }

}

<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\CategoryRepository;
use App\Repositories\CarTypeRepository;
use App\Repositories\CarModelRepository;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\CarTypeResource;
use App\Http\Resources\CarModelResource;
use App\Http\Resources\ProductResource;
use App\Search\ProductSearch\ProductSearch;

class SearchAPIController extends Controller
{
    private  $carTypeRepository, $carModelRepository, $categoryRepository;
    
    public function __construct(
        CarTypeRepository $car_type, 
        CarModelRepository $car_model,
        CategoryRepository $category
    )
    {
        $this->carTypeRepository = $car_type;
        $this->carModelRepository = $car_model;
        $this->categoryRepository = $category;

    }
    
    public function search_filters()
    {
        $car_types = $this->carTypeRepository->all();
        $car_models = $this->carModelRepository->all();
        $manufacturing_year = range(now()->year-20,now()->year);
        $categories = $this->categoryRepository->all();

        $data = [
            'car_types' => CarTypeResource::collection($car_types),
            'car_models' => CarModelResource::collection($car_models),
            'manufacturing_year' => $manufacturing_year,
            'categories' => CategoryResource::collection($categories)
        ];

        return response()->withData(__('api.search_filters'), $data);
    }

    public function search(Request $request)
    {
        $search_result = ProductSearch::apply($request);
                
       return response()->withData(__('api.search_result'), ['products'  => ProductResource::collection($search_result)]);
    }
}

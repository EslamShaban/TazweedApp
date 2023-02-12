<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\CityRepository;
use App\Http\Resources\CityResource;

class CityAPIController extends Controller
{

    private $cityRepository;
    
    public function __construct(CityRepository $city)
    {
        
        $this->cityRepository = $city;

    }

    public function get_cities()
    {
        $cities = $this->cityRepository->all();

        $data = [
            'cities'  => CityResource::collection($cities),   
        ];

        return response()->withData(__('api.all_cities') , $data);
    }
}

<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\SettingRepository;
use App\Http\Resources\SettingResource;

class SettingAPIController extends Controller
{
    private  $settingRepository;
    
    public function __construct(SettingRepository $setting)
    {
        $this->settingRepository = $setting;
    } 
       
    public function settings()
    {
        $settings = $this->settingRepository->first();

        return response()->withData(__('api.settings'), ['settings' => new SettingResource($settings)]);
    }
}

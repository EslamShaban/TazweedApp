<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\File;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function UploadAsset($data, $model, $info = null){
        
        $asset = $data['asset'];
        $path = $data['path_to_save'];

        $asset_name     = $asset->hashName();
        $full_path_url  = $asset->storeAs($path, $asset_name, 'public_path');

        return $model->asset()->create([

            'name'          => $asset_name ,
            'old_name'      => $asset->getClientOriginalName(),
            'size'          => $asset->getSize(),
            'url'           => $full_path_url,
            'mime_type'     => $asset->getMimeType(),
            'info'          => json_encode($info)

        ]);
    }

    public function DeleteAsset($model){
        
        $model->asset ? File::delete($model->asset->url):'';
        $model->asset()->delete();

    }
}

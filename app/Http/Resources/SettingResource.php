<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SettingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'app_name'  => $this->app_name,
            'app_info'  => $this->app_info,
            'app_logo'  => $this->app_logo,
            'service_price' => $this->service_price,
            'delivery_price' => $this->delivery_price,
            'tax'   => $this->tax
        ];
    }
}

<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductDetailsResource extends JsonResource
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
            'id'      => $this->id,
            'name'    => $this->name,
            'image'   => $this->image_path,
            'price'   => $this->price,
            'discount_price'  => $this->discount_price,
            'desc'  => $this->desc,
            'manufacture_country' => $this->country->name,
            'type'  => __('admin.'.$this->type),
            'car_models'    =>  $this->car_models->pluck('model'),
            'features' => $this->features
        ];
    }
}

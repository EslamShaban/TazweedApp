<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class WashRequestResource extends JsonResource
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
            'id'  => $this->id,
            'location' => $this->location,
            'date' => arabicDate(strtotime($this->created_at)),
            'time' => date('h:m A', strtotime($this->created_at)),
            'captain' => new RequestCaptainResource($this->captain),
            'images_before' => $this->images('before'),
            'images_after' => $this->images('after')
        ];
    }
}

<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'id'        => $this->id,
            'f_name'    => $this->f_name,
            'l_name'    => $this->l_name,
            'email'     => $this->email,
            'image'     => $this->image_path,
            'city'      => $this->city->name,
            'phone'     => $this->phone,
            'account_type' => $this->account_type,
            'status'    => intval($this->status)
        ];
    }
}

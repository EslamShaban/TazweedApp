<?php

namespace App\Http\Resources;

use App\Models\Attribute;
use App\Models\AttributeValue;
use Illuminate\Http\Resources\Json\JsonResource;

class AttributeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $attribute = Attribute::find($this->id);
        return [
            'id'      => $this->id,
            'name'    => $this->name,
            'start_date'   => $this->start_date,
            'end_date'   => $this->end_date,
            'discount_type'  => $this->discount_type,
            'discount_amount'  => $this->discount_amount,
            'items'  => $this->attributevalue($attribute),

        ];
    }

    public function attributevalue(Attribute $attribute){
        $attributeValues = AttributeValue::where('attribute_id', $attribute->id)->get();
        return $attributeValues;
    }
}

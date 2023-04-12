<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RequestQuestionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        if($this->questionable_type == 'category'){
            $type = \App\Model\Category::where('id', $this->questionable_id)->first();
        }else{
            $type = \App\Model\Service::where('id', $this->questionable_id)->first();
        }
        return [
            'id'        => $this->id,
            'question'  => $this->question,
            'answer'    => $this->pivot->answer,
            'type'      => $this->questionable_type,
            'type_id'   => $this->questionable_id,
            'type_name' => $type->name
        ];
    }
}

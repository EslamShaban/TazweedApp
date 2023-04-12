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
        $setting = \App\Models\Setting::first();
        $service_price = $setting->service_price;
        $tax = $setting->service_price * $setting->tax / 100;
        $total_price = $service_price + $tax + $this->tip;

        if($this->start_time && $this->end_time){
            $startDateTime = \Carbon\Carbon::createFromFormat('H:i:s', $this->start_time);
            $endDateTime = \Carbon\Carbon::createFromFormat('H:i:s', $this->end_time);
            $duration = $endDateTime->diffInMinutes($startDateTime);
        }else{
            $duration = 0;
        }

        return [
            'id'  => $this->id,
            'location' => $this->location,
            'lat'  => $this->lat,
            'lng'  => $this->lng,
            'duration' => $duration,
            'date' => arabicDate(strtotime($this->created_at)),
            'time' => date('h:m A', strtotime($this->created_at)),
            'captain' => new RequestCaptainResource($this->captain),
            'images_before' => $this->images('before'),
            'images_after' => $this->images('after'),
            'service_price' => $service_price,
            'tax'   => $tax,
            'tip' => $this->tip,
            'total_price' => $total_price,
            'questions' => RequestQuestionResource::collection($this->questions)
        ];
    }
}

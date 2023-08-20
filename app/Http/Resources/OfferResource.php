<?php

namespace App\Http\Resources;

use App\Models\Offer;
use App\Models\OfferDetails;
use Illuminate\Http\Resources\Json\JsonResource;

class OfferResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $offer = Offer::find($this->id);
        return [
            'id'      => $this->id,
            'name'    => $this->name,
            'start_date'   => $this->start_date,
            'end_date'   => $this->end_date,
            'discount_type'  => $this->discount_type,
            'discount_amount'  => $this->discount_amount,
            'items'  => $this->offerDetails($offer),

        ];
    }

    public function offerDetails(Offer $offer){
        $items = OfferDetails::where('offer_id', $offer->id)->get();
        $allItems = [];
        foreach ($items as $item) {
           $allItems[] = $item->model();
        }
        return $allItems;
    }
}

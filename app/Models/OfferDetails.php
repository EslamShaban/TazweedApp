<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfferDetails extends Model
{
    use HasFactory;

    public $fillable = [
        'offer_id',
        'model_type',
        'model_id',
    ];

    public function offer()
    {
        return $this->belongsTo(Offer::class, 'offer_id', 'id');
    }

    public function model(){
        if($this->model_type == 'App\Models\Category'){
            return Category::find($this->model_id);
        }else{
            return Product::find($this->model_id);
        }
    }
}

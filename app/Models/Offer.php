<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Offer extends Model implements TranslatableContract
{
    use HasFactory, Translatable;

    public $translatedAttributes = ['name'];
    protected $fillable = [
        'start_date',
        'end_date',
        'discount_type',
        'discount_amount',
    ];


    public function offerDetails()
    {
        return $this->hasMany(OfferDetails::class,'offer_id');
    }
}

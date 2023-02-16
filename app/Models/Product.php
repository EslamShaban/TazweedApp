<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Product extends Model implements TranslatableContract
{
    use HasFactory, Translatable;

    public $translatedAttributes = ['name', 'desc', 'features'];

    protected $fillable = [
        'type',
        'manufacturing_year',
        'price',
        'discount_price',
        'category_id',
        'car_type_id',
        'manufacture_country'
    ];

        
    public function getImagePathAttribute(){
         
        return asset($this->asset->url);
        
    }

        
    public function scopeOffers($q) 
    {
        return $q->where('discount_price', '>', 0);
    }

    public function asset()
    {
        return $this->morphOne(Asset::class, 'assetable');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function car_type()
    {
        return $this->belongsTo(CarType::class);
    }

        
    public function car_models()
    {
        return $this->belongsToMany(CarModel::class, 'product_car_models');
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'manufacture_country');
    }
}

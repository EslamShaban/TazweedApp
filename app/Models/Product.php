<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'desc',
        'manufacture_country',
        'type',
        'manufacturing_year',
        'price',
        'discount_price',
        'features',
        'category_id',
        'car_type_id'
    ];

        
    protected function features(): Attribute
    {
        return new Attribute(
            get: fn ($value) => json_decode($value, true),
            set: fn ($value) => json_encode($value),
        );
    }
    
        
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
}

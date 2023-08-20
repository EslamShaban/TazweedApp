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
        'is_offer',
        'discount_price',
        'category_id',
        'car_type_id',
        'manufacture_country',
        'brand_id',
        'type',
        'sku',
        'quantity',
        'pro_features',

    ];


    public function getImagePathAttribute(){

        return asset($this->asset->url);

    }

    public function productVariants()
    {
        return $this->hasMany(ProductVariant::class);
    }

    public function scopeOffers($q)
    {
        return $q->where('is_offer', 1);
    }

    public function asset()
    {
        return $this->morphOne(Asset::class, 'assetable');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
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

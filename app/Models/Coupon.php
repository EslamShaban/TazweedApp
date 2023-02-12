<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Coupon extends Model implements TranslatableContract
{
    use HasFactory, Translatable;

    public $translatedAttributes = ['title'];

    protected $fillable = [
        'coupon_code',
        'discount_type',
        'discount_amount',
        'discount_percentage',
        'minimum',
        'start_date',
        'end_date',
        'coupon_usage_limit',
        'coupon_usage_count',
        'product_id',
        'user_id',
    ];
}

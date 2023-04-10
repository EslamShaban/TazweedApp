<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Setting extends Model implements TranslatableContract
{
    use HasFactory, Translatable;

    public $translatedAttributes = ['app_name', 'app_info', 'privacy_page', 'terms_page'];
        
        
    protected $fillable = [
        'service_price',
        'delivery_price',
        'tax',
        'email',
        'phone',
        'facebook',
        'twitter',
        'instagram',
        'youtube'
    ];
        
    public function asset()
    {
        return $this->morphOne(Asset::class, 'assetable');
    }

    public function getAppLogoAttribute(){
         
        return asset(($this->asset->url ?? 'assets/images/app_logo.svg'));
        
    }
}


<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Service extends Model implements TranslatableContract
{
    use HasFactory, Translatable;

    public $translatedAttributes = ['name'];
        
    public function getImagePathAttribute(){
         
        return asset($this->asset->url);
        
    }

    public function asset()
    {
        return $this->morphOne(Asset::class, 'assetable');
    }
}

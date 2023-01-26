<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

        
    public function getImagePathAttribute(){
         
        return asset($this->asset->url);
        
    }

    public function asset()
    {
        return $this->morphOne(Asset::class, 'assetable');
    }
}
